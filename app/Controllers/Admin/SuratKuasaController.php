<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SuratKuasaModel;
use App\Models\UserModel;
use App\Models\PengaduanModel;
use Dompdf\Dompdf;

class SuratKuasaController extends BaseController
{
    protected $suratKuasaModel;
    protected $session;
    protected $auth;
    protected $pengaduan;
    protected $user;

    public function __construct()
    {
        $this->suratKuasaModel = new SuratKuasaModel();
        $this->auth = service('auth');
        $this->session = session();
        $this->pengaduan = new PengaduanModel();
        $this->user = new UserModel();


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
        $data = [
            'title' => 'Daftar Surat Kuasa',
            'surat_kuasa' => $this->suratKuasaModel->findAll()
        ];

        return view('admin/suratkuasa/list_pengajuan_suratkuasa', $data);
    }
    // Form untuk admin (penerima kuasa)
    public function formAdmin($id)
    {
        $data['surat'] = $this->suratKuasaModel->find($id);
        $data['title'] = 'Form Surat Kuasa';

        return view('admin/suratkuasa/edit_suratkuasa', $data);
    }

    // Proses simpan data penerima kuasa dari admin
    public function submitAdmin($id)
    {
        $data = [
            'nomor_surat' => $this->request->getPost('nomor_surat'),
            'nama_penerima' => $this->request->getPost('nama_penerima'),
            'pekerjaan_penerima' => $this->request->getPost('pekerjaan_penerima'),
            'kantor_penerima' => $this->request->getPost('kantor_penerima'),
            'alamat_penerima' => $this->request->getPost('alamat_penerima'),
            'hp_penerima' => $this->request->getPost('hp_penerima'),
            'email_penerima' => $this->request->getPost('email_penerima'),
            'status' => 'lengkap' // Menandakan data lengkap
        ];

        $this->suratKuasaModel->update($id, $data);

        return redirect()->to('admin/suratkuasa/list_pengajuan_suratkuasa'); // Admin bisa melihat surat kuasa lengkap
    }

    public function unduhSuratKuasa($id)
    {
        // Ambil data surat kuasa berdasarkan ID
        $suratKuasa = $this->suratKuasaModel->find($id);
        if (!$suratKuasa) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Surat Kuasa tidak ditemukan');
        }
        // Siapkan data untuk view surat kuasa
        $data = [
            'suratKuasa' => $suratKuasa
        ];

        // Load HTML view dan konversi ke string
        $html = view('admin/suratkuasa/surat_kuasa', $data);

        // Inisialisasi Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Kirim file PDF untuk diunduh
        $dompdf->stream("Surat_Kuasa_{$suratKuasa['nama_pemberi']}_{$suratKuasa['id']}.pdf", ['Attachment' => true]);
    }
}
