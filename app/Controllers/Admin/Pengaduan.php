<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PengaduanModel;
use App\Models\BuktiModel;
use App\Models\UserModel;
use App\Models\PengacaraModel;
use Dompdf\Dompdf;

class Pengaduan extends BaseController
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
		$this->pengaduan = new PengaduanModel();
		$this->bukti = new BuktiModel();
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
	// App/Models/Admin/PengaduanModel.php

	public function approval($id)
	{
		log_message('info', 'Mencoba update status pengaduan dengan ID: ' . $id);

		// Ambil row_status langsung dari database
		$pengaduan = $this->pengaduan->find($id);
		if ($pengaduan) {
			$status = (int) $pengaduan['row_status']; // Ambil nilai row_status dari database
			$new_status = $status + 1;

			log_message('info', 'Status sebelum update: ' . $status);
			log_message('info', 'Status setelah increment: ' . $new_status);

			// Update row_status
			$result = $this->pengaduan->updateStatus($id, $new_status);

			if ($result) {
				session()->setFlashData('msg', 'Status pengaduan berhasil diperbarui.');
			} else {
				session()->setFlashData('error', 'Gagal memperbarui status pengaduan.');
			}

			log_message('info', 'Hasil updateStatus: ' . json_encode($result));
		} else {
			session()->setFlashData('error', 'Data pengaduan tidak ditemukan.');
		}

		return redirect()->to('/admin/pengaduan/' . $id);
	}

	public function soft_delete($id)
	{
		$this->bukti->soft_delete($id);

		$result = $this->pengaduan->save([
			'id' => $id,
			'deleted_at' => date('Y-m-d H:i:s'),
			'row_status' => 0
		]);
		log_message('info', 'Soft delete Pengaduan result: ' . json_encode($result));

		$this->session->setFlashdata('msg', 'Data berhasil dihapus.');
		return redirect()->to('/admin/pengaduan');
	}

	public function detail($id)
	{
		// helper('form'); // Load helper form di sini

		$data = [
			'user' => $this->user,
			'title' => 'Detail Pengaduan',
			'data' => $this->pengaduan->find($id),
			'bukti' => $this->bukti->getBukti($id),
		];

		if (empty($data['data'])) {
			log_message('error', 'Pengaduan tidak ditemukan for ID: ' . $id);
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Pengaduan tidak ditemukan.');
		}

		log_message('info', 'Pengaduan detail data: ' . json_encode($data['data']));
		return view('admin/pengaduan/detail_pengaduan', $data);
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

		// Mengambil data pengaduan dari database
		$dataPengaduan =  $this->pengaduan->withDeleted()->findAll();

		// Memformat status pengaduan langsung dalam controller
		foreach ($dataPengaduan as &$pengaduan) {
			log_message('info', 'Row status: ' . $pengaduan['row_status']);
			switch ($pengaduan['row_status']) {
				case 0:
					$pengaduan['row_status'] = '<span class="badge-danger p-1 rounded-sm">Dihapus</span>';
					break;
				case 1:
					$pengaduan['row_status'] = '<span class="badge-primary p-1 rounded-sm">Baru</span>';
					break;
				case 2:
					$pengaduan['row_status'] = '<span class="badge-success p-1 rounded-sm">Diproses</span>';
					break;
				case 3:
					$pengaduan['row_status'] = '<span class="badge-info p-1 rounded-sm">Selesai</span>';
					break;
				default:
					$pengaduan['row_status'] = '<span class="badge-secondary p-1 rounded-sm">Tidak Diketahui</span>';
					break;
			}
		}

		$data = [
			'user' => $this->user,
			'title' => 'Daftar Semua Pengaduan',
			'pengaduan' => $dataPengaduan,
		];

		return view('admin/pengaduan/index', $data);
	}


	public function pengaduan_masuk()
	{
		$user = user();
		if (!$user) {
			session()->setFlashdata('error', 'Anda harus login untuk melihat pengaduan.');
			return redirect()->to('/login');
		}

		// Load the form helper
		helper('form');

		// Periksa apakah ada permintaan untuk update status
		if ($this->request->getMethod() === 'post') {
			$id = $this->request->getPost('id');
			return $this->approval($id); // Panggil metode approval dengan ID yang diterima
		}

		// Ambil data pengaduan dari model
		$data['pengaduan'] = $this->pengaduan->where('row_status', 1)->findAll(); // Status row_status 1 untuk pengaduan masuk

		$data['user'] = $this->user;
		$data['title'] = 'Daftar Pengaduan - Masuk';

		return view('admin/pengaduan/masuk', $data);
	}

	public function pengaduan_diproses()
	{
		log_message('info', 'pengaduan_diproses diakses');
		$this->user = user();

		if (!session()->get('logged_in')) {
			log_message('error', 'User tidak login saat mengakses pengaduan_diproses');
			return redirect()->to('/login');
		}

		if (!in_groups('admin') && !in_groups('user_role')) {
			log_message('error', 'User tidak memiliki izin untuk mengakses pengaduan_diproses');
			return redirect()->to('/');
		}
		helper('form');


		// // Ambil data pengaduan yang sedang diproses dari model
		// // Sesuaikan dengan status yang ada di model (1, 2, 3, dst.)
		// $data['pengaduan'] = $this->pengaduan->where('row_status', 2)->findAll(); // Ganti '1' dengan status yang sesuai

		// $data['user'] = $this->user;
		// $data['title'] = 'Daftar Pengaduan - Sedang Diproses';

		$data = [
			'pengaduan' => $this->pengaduan->where('row_status', 2)->findAll(),
			'user' => $this->user,
			'title' => 'Daftar Pengaduan - Sedang Diproses',
			'pengacaraList' => $this->pengacara->findAll(),
		];

		return view('admin/pengaduan/diproses', $data);
	}

	public function pengaduan_diselesaikan()
	{
		helper('form');
		log_message('info', 'pengaduan_diselesaikan accessed');
		$this->user = user();

		if (!session()->get('logged_in')) {
			log_message('error', 'User not logged in when accessing pengaduan_diselesaikan');
			return redirect()->to('/login');
		}

		if (!in_groups('admin') && !in_groups('user_role')) {
			log_message('error', 'User does not have permission to access pengaduan_diselesaikan');
			return redirect()->to('/');
		}

		$user = user();
		if (!$user) {
			session()->setFlashdata('error', 'Anda harus login untuk melihat pengaduan.');
			return redirect()->to('/login');
		}

		// Mengambil data pengaduan yang telah diselesaikan
		$data['pengaduan'] = $this->pengaduan->where('row_status', 3)->findAll();
		$data['user'] = $this->user;
		$data['title'] = 'Daftar Pengaduan - Diselesaikan';

		return view('admin/pengaduan/diselesaikan', $data);
	}

	public function pengaduan_dihapus()
	{
		helper('form');
		log_message('info', 'pengaduan_diselesaikan accessed');
		$this->user = user();

		if (!session()->get('logged_in')) {
			log_message('error', 'User not logged in when accessing pengaduan_diselesaikan');
			return redirect()->to('/login');
		}

		if (!in_groups('admin') && !in_groups('user_role')) {
			log_message('error', 'User does not have permission to access pengaduan_diselesaikan');
			return redirect()->to('/');
		}

		$user = user();
		if (!$user) {
			session()->setFlashdata('error', 'Anda harus login untuk melihat pengaduan.');
			return redirect()->to('/login');
		}

		// Mengambil data pengaduan yang telah diselesaikan
		$data['pengaduan'] = $this->pengaduan->withDeleted()->where('row_status', 0)->findAll();
		$data['user'] = $this->user;
		$data['title'] = 'Daftar Pengaduan - Dihapus';

		return view('admin/pengaduan/dihapus', $data);
	}


	public function unduhLaporanSemuaPengguna()
	{
		$this->user = new UserModel();
		// Ambil semua data pengguna
		$users = $this->user->getAllUsers();

		// Siapkan data untuk laporan
		$data = [
			'judul' => 'Laporan Semua Pengguna',
			'users' => $users
		];

		// Load HTML view dan konversi ke string
		$html = view('admin/laporan_semua_pengguna', $data);

		// Inisialisasi Dompdf
		$dompdf = new Dompdf();
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();

		// Kirim file PDF untuk diunduh
		$dompdf->stream('laporan_semua_pengguna', ['Attachment' => true]);
	}

	public function unduhLaporan($status)
	{
		// Tentukan judul dan data pengaduan berdasarkan status
		$judul = '';
		if ($status === 'all') {
			$judul = 'Laporan Semua Pengaduan';
			$dataPengaduan = $this->pengaduan->withDeleted()->findAll();
			// Ambil semua pengaduan
		} else {
			switch ($status) {
				case 1:
					$judul = 'Laporan Pengaduan Baru';
					break;
				case 2:
					$judul = 'Laporan Pengaduan Diproses';
					break;
				case 3:
					$judul = 'Laporan Pengaduan Selesai';
					break;
				default:
					$judul = 'Laporan Pengaduan';
					break;
			}
			$dataPengaduan = $this->pengaduan->getPengaduanByStatus($status); // Ambil pengaduan berdasarkan row_status
		}

		// Siapkan data untuk dikirim ke view laporan
		$data = [
			'judul' => $judul,
			'pengaduan' => $dataPengaduan
		];

		// Load HTML view dan konversi ke string
		$html = view('admin/laporan_pengaduan', $data);

		// Inisialisasi Dompdf
		$dompdf = new Dompdf();
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();

		// Kirim file PDF untuk diunduh
		$dompdf->stream($judul . '.pdf', ['Attachment' => true]);
	}
	public function assign_pengacara()
	{
		// Ambil data dari POST request
		$pengaduanId = $this->request->getPost('pengaduan_id');
		$pengacaraId = $this->request->getPost('pengacara_id');

		// Cek jika data tidak valid
		if (!$pengaduanId || !$pengacaraId) {
			return redirect()->back()->with('error', 'Data tidak valid.');
		}

		// Ambil nama pengacara berdasarkan pengacara_id
		$pengacara = $this->pengacara->find($pengacaraId);

		if (!$pengacara || empty($pengacara['nama_pengacara'])) {
			return redirect()->back()->with('error', 'Nama pengacara tidak ditemukan.');
		}

		// Data untuk update
		$dataToUpdate = [
			'pengacara' => $pengacara['nama_pengacara'] // Menyimpan nama pengacara
		];

		if (empty($dataToUpdate)) {
			return redirect()->back()->with('error', 'Tidak ada data yang diupdate.');
		}

		// Perbarui tabel pengaduan dengan nama pengacara
		$this->pengaduan->update($pengaduanId, $dataToUpdate);

		// Redirect kembali dengan pesan sukses
		return redirect()->back()->with('success', 'Pengacara berhasil ditugaskan.');
	}
}
