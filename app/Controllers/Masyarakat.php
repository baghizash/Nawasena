<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PengaduanModel;

class Masyarakat extends BaseController
{
    protected $db, $builder, $userModel, $validation, $session, $pengaduanModel;

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

    public function index(): string
    {
        $pengaduanModel = new PengaduanModel();
        $userId = session()->get('user_id');  // Sesuaikan dengan sesi pengguna yang login

        // Ambil statistik pengaduan berdasarkan status
        $stats = $pengaduanModel->getPengaduanStats($userId);

        // Ambil pengaduan terbaru
        $pengaduanTerbaru = $pengaduanModel->getPengaduanTerbaru($userId);


        $data = [
            'user' => $this->user,
            'title' => 'Dashboard - Masyarakat',
            'stats' => $stats,
            'pengaduanTerbaru' => $pengaduanTerbaru,
        ];
        // Kirim data ke view
        return view('masyarakat/index', $data);
    }

    public function profile()
    {
        // Memastikan pengguna sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Memeriksa role pengguna
        if (!in_groups('masyarakat') && !in_groups('user_role')) { // Ganti 'user_role' dengan nama role yang sesuai
            return redirect()->to('/'); // Atau halaman lain jika tidak memiliki hak akses
        }

        // Ambil data pengguna untuk ditampilkan
        $userId = session()->get('user_id');
        $data['user'] = $this->userModel->getUserLogin($userId);
        $data['title'] = 'Profile - Masyarakat';

        return view('masyarakat/profile', $data);
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
            'email' => [
                'rules'  => 'required|valid_email|is_unique[users.email,id,' . $postData['id'] . ']',
                'errors' => [
                    'is_unique' => 'Email sudah digunakan oleh pengguna lain.'
                ]
            ],
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
            ]
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
            'email'      => $postData['email'],
            'no_hp'      => $postData['no_hp'],
            'address'    => $postData['address'],
            'NIK'        => $postData['NIK'],

        ];

        // Update data pengguna
        if (!$this->userModel->update($postData['id'], $dataToUpdate)) {
            log_message('error', 'Gagal mengupdate profil pengguna. Kesalahan: ' . json_encode($this->userModel->errors()));
            return redirect()->back()->with('error', 'Gagal mengupdate profil pengguna');
        }

        log_message('info', 'Profil pengguna berhasil diperbarui');
        return redirect()->to('/masyarakat/profile')->with('success', 'Profil berhasil diperbarui');
    }




    // Fungsi untuk membersihkan input
    private function sanitizeInput($input)
    {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }




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
