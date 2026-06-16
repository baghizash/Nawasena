<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PengaduanModel;
use App\Models\BuktiModel;
use App\Models\UserModel;
// use App\Models\GroupModel;
use Myth\Auth\Authorization\GroupModel; // Menggunakan GroupModel dari Myth\Auth


class Pengaduan extends BaseController
{
    protected $pengaduan;
    protected $bukti;
    protected $db;
    protected $auth;
    protected $groupModel;
    protected $user;

    public function __construct()
    {
        // Load model dan service yang dibutuhkan
        $this->pengaduan = new PengaduanModel();
        $this->bukti = new BuktiModel();
        $this->db = \Config\Database::connect();
        $this->auth = service('auth');

        // Ambil user ID dan role dari session
        $userId = session()->get('logged_in');

        // Jika belum login, redirect ke halaman login
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $this->user = user();

        if (!$this->user) {
            return redirect()->to('/login')->with('error', 'User tidak ditemukan.');
        }

        log_message('debug', 'User data: ' . print_r($this->user, true));
    }

    public function index()
    {
        $this->user = user();
        // Memastikan pengguna sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Memeriksa role pengguna
        if (!in_groups('masyarakat') && !in_groups('user_role')) { // Ganti 'user_role' dengan nama role yang sesuai
            return redirect()->to('/'); // Atau halaman lain jika tidak memiliki hak akses
        }
        $data = [
            'title' => 'Daftar Pengaduan Saya',
            'data' => $this->pengaduan->where(['user_id' => $this->user->id])
                ->orderBy('created_at', 'DESC')->findAll()
        ];


        return view('masyarakat/pengaduan/index', $data);
    }

    public function tambah()
    {
        $this->user = user();
        // Memeriksa role pengguna
        if (!in_groups('masyarakat') && !in_groups('user_role')) { // Ganti 'user_role' dengan nama role yang sesuai
            return redirect()->to('/'); // Atau halaman lain jika tidak memiliki hak akses
        }


        helper(['form']);
        return view('masyarakat/pengaduan/tambah_pengaduan', [
            'user' => $this->user,
            'validation' => \Config\Services::validation(),
            'title' => 'Tambah Pengaduan'
        ]);
    }
    public function tambah_pengaduan()
    {
        // Ambil data pengguna dari session
        $user = user(); // Menggunakan Myth\Auth helper

        if (!$user) {
            session()->setFlashdata('error', 'Anda harus login untuk mengajukan pengaduan.');
            return redirect()->to('/login');
        }

        // Aturan validasi
        $rules = [
            'nama_pengadu' => [
                'rules' => 'required|alpha_space|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => 'Nama pengadu wajib diisi.',
                    'alpha_space' => 'Nama pengadu hanya boleh berisi huruf dan spasi.',
                    'min_length' => 'Nama pengadu minimal 3 karakter.',
                    'max_length' => 'Nama pengadu maksimal 100 karakter.'
                ]
            ],
            'judul_pengaduan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Perihal pengaduan wajib diisi.'
                ]
            ],
            'isi_pengaduan' => [
                'rules' => 'required|min_length[30]',
                'errors' => [
                    'required' => 'Isi pengaduan wajib diisi.',
                    'min_length' => 'Minimal 30 karakter.'
                ]
            ],
            'images' => [
                'rules' => 'uploaded[images.0]|max_size[images,1024]|is_image[images]|mime_in[images,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Satu file wajib ada.',
                    'max_size' => 'Anda mengupload file yang melebihi ukuran maksimal.',
                    'is_image' => 'Anda mengupload file yang bukan gambar.',
                    'mime_in' => 'Anda mengupload file yang bukan gambar.'
                ]
            ],
            // Jika menggunakan NIK atau kontak sebagai validasi
            'NIK' => [
                'rules' => 'required|numeric|max_length[30]',
                'errors' => [
                    'required' => 'NIK wajib diisi.',
                    'numeric' => 'NIK harus berupa angka.',
                    'min_length' => 'NIK harus terdiri dari 16 karakter.',
                    'max_length' => 'NIK tidak boleh lebih dari 16 karakter.'
                ]
            ],
            'lokasi_pengaduan' => [
                'rules' => 'required|min_length[5]|max_length[255]',
                'errors' => [
                    'required' => 'Lokasi pengaduan wajib diisi.',
                    'min_length' => 'Lokasi pengaduan minimal 5 karakter.',
                    'max_length' => 'Lokasi pengaduan maksimal 255 karakter.'
                ]
            ],
            'kontak_pengadu' => [
                'rules' => 'required|numeric|max_length[30]',
                'errors' => [
                    'required' => 'Kontak pengadu wajib diisi.',
                    'numeric' => 'Kontak pengadu hanya boleh berisi angka.',
                    'min_length' => 'Kontak pengadu minimal 10 angka.',
                    'max_length' => 'Kontak pengadu maksimal 15 angka.'
                ]
            ],


        ];
        if (!$this->validate($rules)) {
            // Menambahkan pesan error berdasarkan validasi
            session()->setFlashdata('validation', $this->validator->getErrors());
            return redirect()->to('/pengaduan/tambah')->withInput();
        }




        // JIKA LOLOS VALIDASI > CHECKING FILE
        $images = $this->request->getFileMultiple('images');
        if (count($images) > 3) {
            session()->setFlashdata('err-files', '<span class="text-danger">Jumlah file yang anda upload melebihi aturan (max 3 file).</span>');
            return redirect()->to('/pengaduan/tambah');
        }

        $namaPengadu = $this->request->getPost('nama_pengadu');

        $this->db->transBegin(); // Mulai transaksi database

        try {
            // Simpan pengaduan
            $this->pengaduan->save([
                'user_id' => $user->id,
                'nama_pengadu' => $namaPengadu,
                'judul_pengaduan' => $this->request->getPost('judul_pengaduan'),
                'isi_pengaduan' => $this->request->getPost('isi_pengaduan'),
                'kategori_pengaduan' => $this->request->getPost('kategori_pengaduan'),
                'lokasi_pengaduan' => $this->request->getPost('lokasi_pengaduan'),
                'kontak_pengadu' => $this->request->getPost('kontak_pengadu'),
                'NIK' => $this->request->getPost('NIK')
            ]);

            $pengaduan_id = $this->pengaduan->insertID(); // last insert id

            // Inisialisasi array data untuk menyimpan file bukti
            $dataBukti = [
                'pengaduan_id' => $pengaduan_id,
                'img_satu' => null,
                'img_dua' => null,
                'img_tiga' => null,
            ];

            // Simpan file bukti sesuai indeks
            foreach ($images as $i => $img) {
                if ($img->isValid() && !$img->hasMoved()) {
                    $fileName = $img->getRandomName();
                    $img->move('uploads', $fileName);

                    // Tentukan kolom yang sesuai dengan indeks
                    if ($i === 0) {
                        $dataBukti['img_satu'] = $fileName;
                    } elseif ($i === 1) {
                        $dataBukti['img_dua'] = $fileName;
                    } elseif ($i === 2) {
                        $dataBukti['img_tiga'] = $fileName;
                    }
                }
            }

            // Simpan informasi file ke tabel bukti
            $this->bukti->save($dataBukti);

            $this->db->transCommit(); // Commit transaksi
        } catch (\Exception $e) {
            $this->db->transRollback(); // Rollback jika ada error
            session()->setFlashdata('error-msg', 'Terjadi kesalahan, data gagal ditambah: ' . $e->getMessage());
            return redirect()->to('/pengaduan');
        }

        session()->setFlashdata('msg', 'Pengaduan berhasil ditambah, silahkan menunggu untuk proses approval.');
        return redirect()->to('/pengaduan');
    }
    public function detail($id)
    {
        $user = user();
        if (!$user) {
            session()->setFlashdata('error', 'Anda harus login untuk mengajukan pengaduan.');
            return redirect()->to('/login');
        }

        // Mengambil data pengaduan berdasarkan ID
        $dataPengaduan = $this->pengaduan->find($id);
        if (empty($dataPengaduan)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data pengaduan tidak ditemukan');
        }

        // Mengambil bukti pengaduan
        $buktiPengaduan = $this->bukti->getBukti($id);


        // Menyiapkan data untuk view
        $data = [
            'user' => $this->user,
            'title' => 'Detail Pengaduan',
            'data' => $dataPengaduan, // Data pengaduan
            'bukti' => $buktiPengaduan, // Data bukti pengaduan
        ];


        if (empty($data['data'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan');
        }
        // Debugging
        log_message('debug', 'Data pengaduan: ' . print_r($data['data'], true));

        return view('masyarakat/pengaduan/detail', $data);
    }

    public function ubah($id)
    {
        // Memuat helper form
        helper(['form']);
        $user = user();
        $this->user = user(); // pastikan ini mengembalikan data yang valid

        if (!$user) {
            session()->setFlashdata('error', 'Anda harus login untuk mengajukan pengaduan.');
            return redirect()->to('/login');
        }
        // Mengambil data pengaduan berdasarkan ID
        $dataPengaduan = $this->pengaduan->find($id);
        if (empty($dataPengaduan)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data pengaduan tidak ditemukan');
        }

        // Mengambil bukti pengaduan
        $buktiPengaduan = $this->bukti->getBukti($id);

        $data = [
            'user' => $this->user,
            'title' => 'Ubah Data Pengaduan Saya',
            'data' => $dataPengaduan,
            'bukti' => $this->bukti->getBukti($id),
            'validation' => $this->validation
        ];

        // cegah id yang tidak jelas
        if (empty($data['data'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan di awal');
        } else {
            // cek jika row_status = 0 | cegah akses form ubah.
            if ($data['data']['row_status'] == 0) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan di tengah');
            } else {
                // cek jika pengaduan sudah diproses tidak bisa diubah lagi
                if ($data['data']['row_status'] != 1) {
                    throw new \CodeIgniter\Exceptions\PageNotFoundException('Anda tidak bisa merubah pengaduan yang sedang di proses');
                }
            }
        }

        return view('masyarakat/pengaduan/ubah_pengaduan', $data);
    }
    public function ubah_pengaduan($id)
    {
        $this->user = user();

        $rules = [
            'judul_pengaduan' => ['rules' => 'required', 'errors' => ['required' => 'Perihal pengaduan wajib diisi.']],
            'isi_pengaduan' => ['rules' => 'required|min_length[30]', 'errors' => ['required' => 'Isi pengaduan wajib diisi.', 'min_length' => 'Minimal 30 karakter.']]
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/pengaduan/ubah/' . $id)->withInput();
        }

        $images = $this->request->getFileMultiple('images') ?? [];

        if (count($images) > 3) {
            session()->setFlashdata('err-files', 'Jumlah file yang anda upload melebihi aturan.');
            return redirect()->to('/pengaduan/ubah/' . $id)->withInput();
        }

        foreach ($images as $img) {
            if ($img->isValid() && !$img->hasMoved()) {
                if ($img->getSizeByUnit('kb') > 1024 || !in_array($img->getMimeType(), ['image/jpg', 'image/jpeg', 'image/png'])) {
                    session()->setFlashdata('err-files', 'File tidak valid atau melebihi ukuran.');
                    return redirect()->to('/pengaduan/ubah/' . $id)->withInput();
                }
            }
        }

        $buktiLama = $this->bukti->find($this->request->getPost('bukti_id'));
        $files = [$buktiLama['img_satu'] ?? null, $buktiLama['img_dua'] ?? null, $buktiLama['img_tiga'] ?? null];

        foreach ($images as $i => $img) {
            if ($img->isValid() && !$img->hasMoved()) {
                $fileName = $img->getRandomName();
                $img->move('uploads', $fileName);
                $files[$i] = $fileName;

                if ($i === 0 && isset($buktiLama['img_satu'])) {
                    @unlink('uploads/' . $buktiLama['img_satu']);
                }
                if ($i === 1 && isset($buktiLama['img_dua'])) {
                    @unlink('uploads/' . $buktiLama['img_dua']);
                }
                if ($i === 2 && isset($buktiLama['img_tiga'])) {
                    @unlink('uploads/' . $buktiLama['img_tiga']);
                }
            }
        }

        $this->db->transBegin();

        try {
            $this->pengaduan->update($id, [
                'id' => $id,
                'user_id' => $this->user->id,
                'nama_pengadu' => $this->request->getPost('nama_pengadu'),
                'judul_pengaduan' => $this->request->getPost('judul_pengaduan'),
                'isi_pengaduan' => $this->request->getPost('isi_pengaduan'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            $this->bukti->update($this->request->getPost('bukti_id'), [
                'img_satu' => $files[0],
                'img_dua' => $files[1],
                'img_tiga' => $files[2],
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            $this->db->transCommit();
        } catch (\Exception $e) {
            $this->db->transRollback();
            session()->setFlashdata('error-msg', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->to('/pengaduan/ubah/' . $id)->withInput();
        }

        session()->setFlashdata('msg', 'Pengaduan berhasil diubah.');
        return redirect()->to('/pengaduan');
    }
}
