<?php

namespace App\Controllers;

use App\Models\PengaduanModel;
use App\Models\UserModel;
// use App\Models\PengaduanModel;

class Admin extends BaseController
{
    protected $db, $builder, $userModel, $validation, $session, $pengaduan;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('users');
        $this->userModel = new UserModel(); // Load UserModel

        $this->validation = \Config\Services::validation(); // Load validation service
        $this->session = session();

        // Ambil user ID dan role dari session
        $userId = $this->session->get('logged_in');
        log_message('info', 'User ID: ' . json_encode($userId));

        // Jika belum login, redirect ke halaman login
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $this->user = user();
        log_message('info', 'User data: ' . json_encode($this->user));

        if (!$this->user) {
            return redirect()->to('/login')->with('error', 'User tidak ditemukan.');
        }
    }

    public function index()
    {
        $this->pengaduan = new PengaduanModel();
        $this->userModel = new UserModel();

        $rentang = $this->request->getGet('rentang'); // Ambil rentang dari GET

        // Tentukan rentang default jika tidak ada yang dipilih
        if (!$rentang) {
            $rentang = 'last_week'; // Ganti sesuai dengan rentang default Anda
        }

        // Ambil data grafik sesuai dengan rentang yang dipilih
        switch ($rentang) {
            case 'last_week':
                $dataChart = $this->pengaduan->getDataForLastWeek();
                break;
            case 'last_month':
                $dataChart = $this->pengaduan->getDataForLastMonth();
                break;
            case 'last_6_months':
                $dataChart = $this->pengaduan->getDataForLast6Months();
                break;
            case 'last_year':
                $dataChart = $this->pengaduan->getDataForLastYear();
                break;
            default:
                $dataChart = [];
                break;
        }

        // Ambil data per status
        $pengaduan_baru = $this->pengaduan->countByStatusAndTime(1, $rentang); // Status 1: Pengaduan Baru
        $pengaduan_diproses = $this->pengaduan->countByStatusAndTime(2, $rentang); // Status 2: Pengaduan Diproses
        $pengaduan_selesai = $this->pengaduan->countByStatusAndTime(3, $rentang); // Status 3: Pengaduan Selesai

        // Menyusun data untuk Chart.js
        $chartData = [
            'categories' => $dataChart['categories'],  // Kategori seperti bulan atau tanggal
            // 'pengaduan_baru' => $pengaduan_baru,
            // 'pengaduan_diproses' => $pengaduan_diproses,
            // 'pengaduan_selesai' => $pengaduan_selesai
            'pengaduan_baru' => [0, 1, 3, 2, 5, 0, 0],
            'pengaduan_diproses' => [0, 0, 1, 2, 1, 0, 0],
            'pengaduan_selesai' => [0, 1, 0, 1, 0, 0, 0]
        ];
        $userId = session()->get('user_id');
        $data['user'] = $this->userModel->getUserLogin($userId);
        $data = [
            'title' => 'Dashboard Admin',
            'Pengaduan_baru' => $this->pengaduan->countByRowStatus1(),
            'Pengaduan_diproses' => $this->pengaduan->countByRowStatus2(),
            'Pengaduan_selesai' => $this->pengaduan->countByRowStatus3(),
            'jumlah_user' => $this->userModel->countAllUser(),
            'pengaduan_masuk_last_week' => $this->pengaduan->countByStatusAndTime(1, 'last_week'),
            'pengaduan_diproses_last_month' => $this->pengaduan->countByStatusAndTime(2, 'last_month'),
            'pengaduan_selesai_last_year' => $this->pengaduan->countByStatusAndTime(3, 'last_year'),
            'rentang' => $rentang,
            'chartData' => $chartData,
        ];

        return view('admin/index', $data);
    }



    public function profile()
    {
        // Memastikan pengguna sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Memeriksa role pengguna
        if (!in_groups('admin') && !in_groups('user_role')) { // Ganti 'user_role' dengan nama role yang sesuai
            return redirect()->to('/admin'); // Atau halaman lain jika tidak memiliki hak akses
        }

        // Ambil data pengguna untuk ditampilkan
        $userId = session()->get('user_id');
        $data['user'] = $this->userModel->getUserLogin($userId);
        $data['title'] = 'Profile Pengguna';

        return view('admin/profile', $data);
    }


    public function userList($id = null)
    {
        // Memastikan pengguna sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Memeriksa role pengguna
        if (!in_groups('admin') && !in_groups('user_role')) {
            return redirect()->to('/admin');
        }

        if ($id) {
            // Jika ada ID, ambil detail pengguna
            $data['title'] = 'User Detail';

            $this->builder->select('users.id as userid, username, email, user_image, name');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->where('users.id', $id);
            $query = $this->builder->get();

            $data['user'] = $query->getRow();

            if (empty($data['user'])) {
                return redirect()->to('/admin/user-list'); // Redirect jika user tidak ditemukan
            }

            return view('admin/detail', $data); // Tampilkan halaman detail
        } else {
            // Jika tidak ada ID, tampilkan daftar pengguna
            $data['title'] = 'Daftar Pengguna Nawasena';

            $this->builder->select('users.id as userid, username, email, auth_groups.name as role_name');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $query = $this->builder->get();

            $data['users'] = $query->getResult();

            return view('admin/user-list', $data); // Tampilkan halaman user-list
        }
    }

    public function detail($id = 0)
    {
        // Memastikan pengguna sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Memeriksa role pengguna yang login untuk mengakses halaman ini
        if (!in_groups('admin') && !in_groups('user_role')) {
            return redirect()->to('/admin');
        }

        $data['title'] = 'User Detail';

        $this->builder->select('users.id as userid, username, email, user_image, auth_groups.name as group_name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);
        $query = $this->builder->get();

        $data['user'] = $query->getRow();

        if (empty($data['user'])) {
            return redirect()->to('/admin/user-list'); // Redirect jika user tidak ditemukan
        }

        // Cek jika user yang sedang dilihat adalah admin
        $data['is_admin'] = ($data['user']->group_name == 'admin');

        // Mengambil daftar pengaduan user jika role bukan admin
        if (!$data['is_admin']) {
            $this->pengaduan = new PengaduanModel();
            $data['list_pengaduan'] = [
                'title' => 'Daftar Pengaduan Saya',
                'data' => $this->pengaduan->where(['user_id' => $id, 'row_status' => 1])
                    ->orderBy('created_at', 'DESC')
                    ->findAll()
            ];
        } else {
            $data['list_pengaduan'] = [
                'title' => 'Daftar Pengaduan',
                'data' => [] // Kosongkan jika user adalah admin
            ];
        }

        return view('admin/detail', $data);
    }



    public function getProfile()
    {
        if ($this->request->isAjax()) {
            $id = $this->request->getPost('id');
            $data = $this->userModel->getUserLogin($id);
            echo json_encode($data);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User tidak ditemukan.');
        }
    }

    public function ubah_profile()
    {
        // Ambil data pengguna yang sedang login
        $user = user();

        // Ambil data POST
        $postData = $this->request->getPost();

        // Log data yang diterima
        log_message('info', 'Data POST diterima: ' . json_encode($postData));

        // Validasi ID pengguna
        if (!isset($postData['id']) || empty($postData['id'])) {
            log_message('error', 'ID tidak ditemukan dalam post data');
            return redirect()->back()->with('error', 'ID tidak ditemukan');
        }

        // Ambil data pengguna berdasarkan ID
        $user = $this->userModel->find($postData['id']);
        if (!$user) {
            log_message('error', 'Pengguna dengan ID tersebut tidak ditemukan');
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan');
        }

        // Validasi input (tanpa password)
        $validationRules = [

            'username' => [
                'rules'  => 'required|alpha_numeric_punct|min_length[3]|max_length[30]|is_unique[users.username,id,' . $postData['id'] . ']',
                'errors' => [
                    'is_unique' => 'Username sudah digunakan oleh pengguna lain.'
                ]
            ],
            'user_image' => [
                'rules' => 'uploaded[user_image]|is_image[user_image]|max_size[user_image,2048]',
                'errors' => [
                    'uploaded' => 'File gambar harus diunggah.',
                    'is_image' => 'File yang diunggah harus berupa gambar.',
                    'max_size' => 'Ukuran gambar maksimal adalah 2MB.'
                ]
            ],
            'no_hp' => [
                'rules'  => 'required|numeric|min_length[10]|max_length[15]',
                'errors' => [
                    'required'   => 'Nomor HP wajib diisi.',
                    'numeric'    => 'Nomor HP hanya boleh berisi angka.',
                    'min_length' => 'Nomor HP minimal harus memiliki 10 angka.',
                    'max_length' => 'Nomor HP maksimal boleh memiliki 15 angka.'
                ]
            ],

        ];

        // Validasi data yang dimasukkan
        if (!$this->validate($validationRules)) {
            log_message('error', 'Validasi gagal: ' . json_encode($this->validator->getErrors()));
            return redirect()->back()->with('error', 'Validasi gagal: ' . json_encode($this->validator->getErrors()));
        }

        // Proses upload gambar profil
        $userImage = $this->request->getFile('user_image');
        $newImageName = $user->user_image; // Default ke gambar lama

        if ($userImage && $userImage->isValid() && !$userImage->hasMoved()) {
            $newImageName = $userImage->getRandomName();
            $uploadPath = FCPATH . 'uploads/';
            if (!$userImage->move($uploadPath, $newImageName)) {
                log_message('error', 'Gagal mengunggah gambar pengguna: ' . $userImage->getErrorString());
                return redirect()->back()->with('error', 'Gagal mengunggah gambar. Pastikan format file sesuai.');
            }
        } else {
            log_message('info', 'Tidak ada gambar baru yang diunggah.');
        }

        // Siapkan data yang akan diupdate (kecuali password)
        $dataToUpdate = [
            'user_image' => $newImageName,
            'name'       => $postData['name'],
            'username'   => $postData['username'],

            'no_hp'      => $postData['no_hp'],
            'address'    => $postData['address'],
            'NIK'        => $postData['NIK'],

        ];
        log_message('info', 'Nomor HP diterima: ' . $postData['no_hp']);
        log_message('info', 'Nomor HP disimpan: ' . $dataToUpdate['no_hp']);


        // Update data pengguna
        if (!$this->userModel->update($postData['id'], $dataToUpdate)) {
            log_message('error', 'Gagal mengupdate profil pengguna. Kesalahan: ' . json_encode($this->userModel->errors()));
            return redirect()->back()->with('error', 'Gagal mengupdate profil pengguna');
        }

        log_message('info', 'Profil pengguna berhasil diperbarui');
        return redirect()->to('/admin/profile')->with('success', 'Profil berhasil diperbarui');
    }

    // Fungsi untuk membersihkan input
    // private function sanitizeInput($input)
    // {
    //     return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    // }

    public function ubah_password()
    {
        $rules = [
            'current-password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password lama wajib diisi.'
                ]
            ],
            'new-password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Password baru wajib diisi.',
                    'min_length' => 'Password minimal 8 karakter.'
                ]
            ],
            'confirm-password' => [
                'rules' => 'required|matches[new-password]',
                'errors' => [
                    'required' => 'Konfirmasi password wajib diisi.',
                    'matches' => 'Konfirmasi password tidak sesuai.'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validation->getErrors();
            echo json_encode(['status' => FALSE, 'errors' => $errors]);
        } else {
            $currentPass = strip_tags($this->request->getPost('current-password'));
            $newPass = strip_tags($this->request->getPost('new-password'));

            $userData = $this->userModel->getUserLogin($this->user['id']);
            $userPass = $userData['password'];

            if (!password_verify($currentPass, $userPass)) {
                echo json_encode(['status' => FALSE, 'msg' => 'Password lama salah.']);
            } else {
                if ($currentPass == $newPass) {
                    echo json_encode(['status' => FALSE, 'msg' => 'Password baru tidak boleh sama dengan password lama.']);
                } else {
                    $fix_pass = password_hash($newPass, PASSWORD_DEFAULT);

                    $this->userModel->save([
                        'id' => $this->user['id'],
                        'password' => $fix_pass
                    ]);

                    echo json_encode(['status' => TRUE, 'msg' => 'Password berhasil diperbarui.']);
                }
            }
        }
    }
}
