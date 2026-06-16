<?php

namespace App\Controllers\Masyarakat;

use App\Controllers\BaseController;
use App\Models\SuratKuasaModel;
use App\Models\UserModel;

class SuratKuasaController extends BaseController
{
    protected $suratKuasaModel;
    protected $user;
    protected $db;

    public function __construct()
    {
        // Inisialisasi model dan database
        $this->suratKuasaModel = new SuratKuasaModel();
        $this->db = \Config\Database::connect();
        $this->user = new UserModel();

        // Ambil data pengguna yang sedang login
        $this->user = user();

        // Log untuk debugging
        log_message('debug', 'Konstruktor dipanggil. Nilai user: ' . print_r($this->user, true));

        // Jika user belum login, redirect ke halaman login
        if (!$this->user) {
            session()->setFlashdata('error', 'Anda harus login untuk mengakses halaman ini.');
            redirect()->to('/login');
        }
    }

    // Form untuk masyarakat (pemberi kuasa)
    public function formMasyarakat()
    {
        // Muat helper form
        helper(['form']);
        $this->user = user();

        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        if (!in_groups('masyarakat') && !in_groups('user_role')) { // Ganti 'user_role' dengan nama role yang sesuai
            return redirect()->to('/'); // Atau halaman lain jika tidak memiliki hak akses
        }

        log_message('debug', 'Masuk ke metode formMasyarakat');

        // Cek apakah user memiliki role yang sesuai
        if (!in_groups('masyarakat')) {
            session()->setFlashdata('error', 'Anda tidak memiliki akses ke halaman ini.');
            return redirect()->to('/'); // Redirect ke halaman utama jika tidak memiliki akses
        }
        helper(['form']);
        // Data untuk view
        $data = [
            'title' => 'Form Surat Kuasa',
            'user' => $this->user,
            'validation' => \Config\Services::validation(),
        ];
        // Render view
        return view('masyarakat/suratkuasa/index', $data);
    }

    // Proses simpan data pemberi kuasa dari masyarakat
    public function submitMasyarakat()
    {

        $user = user();
        log_message('debug', 'Masuk ke metode submitMasyarakat');

        // Pastikan pengguna login dan data pengguna tersedia
        if (!$user) {
            session()->setFlashdata('error', 'Anda harus login untuk mengajukan pengaduan.');
            return redirect()->to('/login');
        }

        if (!in_groups('masyarakat')) {
            session()->setFlashdata('error', 'Anda tidak memiliki akses ke halaman ini.');
            return redirect()->to('/'); // Redirect ke halaman utama jika tidak memiliki akses
        }
        if (!$this->validate([
            'nama_pemberi' => 'required',
            'jenis_kelamin_pemberi' => 'required',
            'ttl_pemberi' => 'required',
            'agama_pemberi' => 'required',
            'pekerjaan_pemberi' => 'required',
            'alamat_pemberi' => 'required',
            'nik_pemberi' => 'required|numeric'
        ])) {
            log_message('error', 'Validasi gagal: ' . print_r($this->validator->getErrors(), true));
            session()->setFlashdata('error', 'Validasi gagal. Harap periksa input Anda.');
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        // Ambil data dari form
        $data = [
            'user_id' => $user->id, // Ambil user_id dari data user yang sudah login
            'nama_pemberi' => $this->request->getPost('nama_pemberi'),
            'jenis_kelamin_pemberi' => $this->request->getPost('jenis_kelamin_pemberi'),
            'ttl_pemberi' => $this->request->getPost('ttl_pemberi'),
            'agama_pemberi' => $this->request->getPost('agama_pemberi'),
            'pekerjaan_pemberi' => $this->request->getPost('pekerjaan_pemberi'),
            'alamat_pemberi' => $this->request->getPost('alamat_pemberi'),
            'nik_pemberi' => $this->request->getPost('nik_pemberi'),
            'status' => 'pemberi_selesai' // Menandakan data pemberi sudah diisi
        ];

        // Tambahkan log untuk memeriksa data POST
        log_message('debug', 'Data POST yang diterima: ' . print_r($this->request->getPost(), true));
        log_message('debug', 'Data yang akan disimpan ke database: ' . print_r($data, true));

        // Simpan ke database
        try {
            if ($this->suratKuasaModel->insert($data)) {
                log_message('debug', 'Data berhasil disimpan ke database.');
                session()->setFlashdata('success', 'Data surat kuasa berhasil disimpan.');
                return redirect()->to('/masyarakat/suratkuasa/riwayat');
            } else {
                log_message('error', 'Gagal menyimpan data: ' . json_encode($this->suratKuasaModel->errors()));
                session()->setFlashdata('error', 'Terjadi kesalahan saat menyimpan data. ' . implode(', ', $this->suratKuasaModel->errors()));
                return redirect()->back()->withInput();
            }
        } catch (\Exception $e) {
            log_message('error', 'Exception saat menyimpan data: ' . $e->getMessage());
            session()->setFlashdata('error', 'Terjadi kesalahan sistem. Silakan coba lagi.');
            return redirect()->back()->withInput();
        }
    }

    // Riwayat Surat Kuasa
    public function riwayat()
    {
        $this->user = user();
        if (!in_groups('masyarakat')) {
            session()->setFlashdata('error', 'Anda tidak memiliki akses ke halaman ini.');
            return redirect()->to('/'); // Redirect ke halaman utama jika tidak memiliki akses
        }

        // Ambil data surat kuasa yang terkait dengan user
        $surat_kuasa = $this->suratKuasaModel->where('user_id', $this->user->id)->findAll();
        $data = [
            'title' => 'Riwayat Surat Kuasa',
            'user' => $this->user,
            'surat_kuasa' => $surat_kuasa,
        ];

        return view('masyarakat/suratkuasa/riwayat', $data);
    }

    public function detail($id = null)
    {
        // Logging awal fungsi
        log_message('info', 'Memasuki method detail dengan ID: ' . ($id ?? 'null'));

        // Ambil data user yang sedang login
        $user = user();
        if (!$user) {
            log_message('error', 'Pengguna belum login.');
            session()->setFlashdata('error', 'Anda harus login untuk mengakses halaman ini.');
            return redirect()->to('/login');
        }
        log_message('info', 'Pengguna login dengan ID: ' . $user->id);

        // Pastikan hanya kelompok masyarakat yang bisa mengakses
        if (!in_groups('masyarakat')) {
            log_message('error', 'Pengguna dengan ID: ' . $user->id . ' mencoba mengakses tanpa izin.');
            session()->setFlashdata('error', 'Anda tidak memiliki akses ke halaman ini.');
            return redirect()->to('/');
        }

        // Periksa apakah ID pengajuan disediakan
        if (!$id) {
            log_message('error', 'ID pengajuan tidak ditemukan.');
            session()->setFlashdata('error', 'ID pengajuan tidak ditemukan.');
            return redirect()->back();
        }
        log_message('info', 'ID pengajuan ditemukan: ' . $id);

        // Ambil data detail surat kuasa berdasarkan ID dan user yang sedang login
        $suratKuasaDetail = $this->suratKuasaModel
            ->where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        // Logging hasil query
        if (!$suratKuasaDetail) {
            log_message('error', 'Detail surat kuasa tidak ditemukan. ID: ' . $id . ', User ID: ' . $user->id);
            session()->setFlashdata(
                'error',
                'Detail surat kuasa tidak ditemukan atau Anda tidak memiliki akses.'
            );
            return redirect()->back();
        }
        log_message('info', 'Detail surat kuasa ditemukan: ' . json_encode($suratKuasaDetail));

        // Data yang akan dikirim ke view
        $data = [
            'title' => 'Detail Surat Kuasa',
            'user' => $user,
            'surat_kuasa' => $suratKuasaDetail,
        ];
        log_message('info', 'Data untuk view disiapkan.');

        // Render view
        return view('masyarakat/suratkuasa/detail', $data);
    }

    public function editForm($id = null)
    {
        helper(['form']);
        // Logging awal fungsi
        log_message('info', 'Memasuki method editForm dengan ID: ' . ($id ?? 'null'));

        // Ambil data user yang sedang login
        $user = user();
        if (!$user) {
            log_message('error', 'Pengguna belum login.');
            session()->setFlashdata('error', 'Anda harus login untuk mengakses halaman ini.');
            return redirect()->to('/login');
        }

        // Pastikan hanya kelompok masyarakat yang bisa mengakses
        if (!in_groups('masyarakat')) {
            log_message('error', 'Pengguna dengan ID: ' . $user->id . ' mencoba mengakses tanpa izin.');
            session()->setFlashdata('error', 'Anda tidak memiliki akses ke halaman ini.');
            return redirect()->to('/');
        }

        // Periksa apakah ID surat kuasa disediakan
        if (!$id) {
            log_message('error', 'ID surat kuasa tidak ditemukan.');
            session()->setFlashdata('error', 'ID surat kuasa tidak ditemukan.');
            return redirect()->back();
        }

        // Ambil data surat kuasa berdasarkan ID dan user yang sedang login
        $suratkuasa = $this->suratKuasaModel
            ->where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if (!$suratkuasa) {
            log_message('error', 'Surat kuasa tidak ditemukan atau tidak dimiliki oleh pengguna. ID: ' . $id . ', User ID: ' . $user->id);
            session()->setFlashdata('error', 'Surat kuasa tidak ditemukan atau Anda tidak memiliki akses.');
            return redirect()->back();
        }

        log_message('info', 'Data surat kuasa ditemukan untuk ID: ' . $id);

        // Tampilkan halaman edit
        $data = [
            'title' => 'Edit Surat Kuasa',
            'surat_kuasa' => $suratkuasa,
            'validation' => \Config\Services::validation(),
        ];

        return view('masyarakat/suratkuasa/edit', $data);
    }

    // Fungsi untuk memproses data yang dikirimkan
    public function editProcess($id = null)
    {
        // Logging awal fungsi
        log_message('info', 'Memasuki method editProcess dengan ID: ' . ($id ?? 'null'));

        // Ambil data user yang sedang login
        $user = user();
        if (!$user) {
            log_message('error', 'Pengguna belum login.');
            session()->setFlashdata('error', 'Anda harus login untuk mengakses halaman ini.');
            return redirect()->to('/login');
        }

        // Pastikan hanya kelompok masyarakat yang bisa mengakses
        if (!in_groups('masyarakat')) {
            log_message('error', 'Pengguna dengan ID: ' . $user->id . ' mencoba mengakses tanpa izin.');
            session()->setFlashdata('error', 'Anda tidak memiliki akses ke halaman ini.');
            return redirect()->to('/');
        }

        // Periksa apakah ID surat kuasa disediakan
        if (!$id) {
            log_message('error', 'ID surat kuasa tidak ditemukan.');
            session()->setFlashdata('error', 'ID surat kuasa tidak ditemukan.');
            return redirect()->back();
        }

        // Validasi input
        $rules = [
            'nama_pemberi' => 'required',
            'jenis_kelamin_pemberi' => 'required',
            'ttl_pemberi' => 'required',
            'agama_pemberi' => 'required',
            'pekerjaan_pemberi' => 'required',
            'alamat_pemberi' => 'required',
            'nik_pemberi' => 'required'
        ];

        if (!$this->validate($rules)) {
            log_message('error', 'Validasi gagal untuk ID surat kuasa: ' . $id . '. Error: ' . json_encode($this->validator->getErrors()));
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // Proses update data
        $dataUpdate = [
            'nama_pemberi' => $this->request->getPost('nama_pemberi'),
            'jenis_kelamin_pemberi' => $this->request->getPost('jenis_kelamin_pemberi'),
            'ttl_pemberi' => $this->request->getPost('ttl_pemberi'),
            'agama_pemberi' => $this->request->getPost('agama_pemberi'),
            'pekerjaan_pemberi' => $this->request->getPost('pekerjaan_pemberi'),
            'alamat_pemberi' => $this->request->getPost('alamat_pemberi'),
            'nik_pemberi' => $this->request->getPost('nik_pemberi')
        ];

        log_message('info', 'Data yang akan diperbarui: ' . json_encode($dataUpdate));

        if ($this->suratKuasaModel->update($id, $dataUpdate)) {
            log_message('info', 'Data surat kuasa berhasil diperbarui untuk ID: ' . $id);
            session()->setFlashdata('msg', 'Surat kuasa berhasil diperbarui.');
            return redirect()->back();
        } else {
            log_message('error', 'Gagal memperbarui surat kuasa untuk ID: ' . $id);
            session()->setFlashdata('error', 'Terjadi kesalahan saat menyimpan perubahan.');
            return redirect()->back()->withInput();
        }
    }



    // public function soft_delete($id)
    // {
    //     $this->suratKuasaModel->soft_delete($id);

    //     $result = $this->suratKuasaModel->save([
    //         'id' => $id,
    //         'deleted_at' => date('Y-m-d H:i:s'),
    //         'row_status' => 0
    //     ]);
    //     log_message('info', 'Soft delete Pengaduan result: ' . json_encode($result));

    //     // $this->session->setFlashdata('msg', 'Data berhasil dihapus.');
    //     return redirect()->to('masyarakat/suratkuasa/riwayat');
    // }
}
