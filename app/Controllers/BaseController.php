<?php

namespace App\Controllers;

use App\Models\UserModel; // Pastikan Anda mengimpor UserModel
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use CodeIgniter\Validation\Validation;

abstract class BaseController extends Controller
{

    protected $validation;
    public function __construct()
    {
        // Inisialisasi validasi
        $this->validation = \Config\Services::validation();
    }

    protected $user;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
        session();
        $this->validation = \Config\Services::validation();

        // Ambil data pengguna berdasarkan session id
        $userModel = new UserModel();
        $this->user = $userModel->getUserLogin(session('id'));
    }
}
