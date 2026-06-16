<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PengacaraModel;


class Pengacara extends BaseController
{
    protected $pengaduan;
    protected $bukti;
    protected $user;
    protected $auth;
    protected $db;
    protected $session;
    protected $dompdf;
    protected $pengacara;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->auth = service('auth');
        $this->session = session();
        $this->pengacara = new PengacaraModel();


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
        log_message('info', 'index accessed');
        $this->user = user();

        if (!session()->get('logged_in')) {
            log_message('error', 'User not logged in when accessing index');
            return redirect()->to('/login');
        }

        if (!in_groups('admin') && !in_groups('user_role')) {
            log_message('error', 'User does not have permission to access index');
            return redirect()->to('/');
        }

        $dataPengacara = $this->pengacara->findAll();

        $data = [
            'title' => 'Daftar Pengacara',
            'pengacara' => $dataPengacara,

        ];
        return view('admin/list_pengacara', $data);
    }
}
