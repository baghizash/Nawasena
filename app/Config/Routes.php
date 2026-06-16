<?php

use CodeIgniter\Commands\Utilities\Routes;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

$routes->get('/', 'Utama::index'); // Halaman promosi, blog, informasi perusahaan



$routes->get('login', 'AuthController::login'); // Halaman login
$routes->get('register', 'AuthController::register'); // Halaman registrasi

/// ROUTES ADMIN/////
$routes->group('admin', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('profile', 'Admin::profile'); // Halaman profil admin
    $routes->get('', 'Admin::index'); // Halaman dashboard admin
    $routes->get('user-list', 'Admin::userList'); // Halaman daftar pengguna
    $routes->get('user-list/(:num)', 'Admin::detail/$1'); // Halaman detail pengguna berdasarkan ID
    $routes->post('ubah_profile/(:num)', 'Admin::ubah_profile/$1'); // Mengubah profil admin (dengan parameter ID)

    $routes->get('manage-user', 'Admin\ManageUser::index');
    $routes->get('manage-user/un-verified', 'Admin\ManageUser::user_unverified');
    $routes->get('manage-user/(:any)', 'Admin\ManageUser::detail/$1');
    $routes->put('manage-user/user_activation', 'Admin\ManageUser::user_activation');
    $routes->delete('manage-user/soft_delete', 'Admin\ManageUser::soft_delete');

    // Rute untuk pengaduan
    $routes->get('pengaduan', 'Admin\Pengaduan::index'); // Metode index()
    $routes->post('pengaduan/dt_pengaduan', 'Admin\Pengaduan::dt_pengaduan'); // Metode dt_pengaduan()
    $routes->get('pengaduan/masuk', 'Admin\Pengaduan::pengaduan_masuk'); // Mengambil pengaduan yang masuk
    $routes->get('pengaduan/diproses', 'Admin\Pengaduan::pengaduan_diproses'); // Mengambil pengaduan yang sedang diproses
    $routes->get('pengaduan/diselesaikan', 'Admin\Pengaduan::pengaduan_diselesaikan'); // Mengambil pengaduan yang telah selesai
    $routes->get('pengaduan/dihapus', 'Admin\Pengaduan::pengaduan_dihapus'); // Mengambil pengaduan yang telah selesai
    $routes->get('pengaduan/(:num)', 'Admin\Pengaduan::detail/$1'); // Mengambil detail pengaduan berdasarkan ID
    $routes->delete('pengaduan/(:num)', 'Admin\Pengaduan::soft_delete/$1'); // Menghapus pengaduan berdasarkan ID
    $routes->put('pengaduan/(:num)', 'Admin\Pengaduan::approval/$1'); // Approval pengaduan berdasarkan ID
    $routes->put('/pengaduan/update_status/(:num)', 'Admin\Pengaduan::update_status/$1');
    $routes->post('pengaduan/assign_pengacara', 'Admin\Pengaduan::assign_pengacara');

    //pengacara
    $routes->get('list_pengacara', 'Admin\Pengacara::index'); // Metode index()


    //surat kuasa
    $routes->get('suratkuasa/list_pengajuan_suratkuasa', 'Admin\SuratKuasaController::index');
    $routes->get('suratkuasa/edit_suratkuasa/(:num)', 'Admin\SuratKuasaController::formAdmin/$1');
    $routes->post('suratkuasa/submitAdmin/(:num)', 'Admin\SuratKuasaController::submitAdmin/$1');
    $routes->get('suratkuasa/unduhSuratKuasa/(:num)', 'Admin\SuratKuasaController::unduhSuratKuasa/$1');



    //LAPORAN
    $routes->get('unduhLaporanSemuaPengguna', 'Admin\Pengaduan::unduhLaporanSemuaPengguna');

    $routes->get('pengaduan/unduhLaporan/(:num)', 'Admin\Pengaduan::unduhLaporan/$1');
    $routes->get('pengaduan/unduhLaporan/(:any)', 'Admin\Pengaduan::unduhLaporan/$1');
}); // Admin - Manage Data (hanya admin yang bisa mengakses)

////ROUTES MASYARAKAT////

$routes->group('masyarakat', ['filter' => 'role:masyarakat'], function ($routes) {
    $routes->get('', 'Masyarakat::index');
    $routes->get('profile', 'Masyarakat::profile');
    $routes->post('ubah_profile/(:num)', 'Masyarakat::ubah_profile/$1');

    $routes->group('pengaduan', function ($routes) {
        $routes->get('/', 'Pengaduan::index'); // Halaman daftar pengaduan
        $routes->get('detail/(:num)', 'Pengaduan::detail/$1');
        $routes->delete('/(:num)', 'Pengaduan::soft_delete/$1'); // Menghapus pengaduan secara soft delete
        $routes->get('tambah', 'Pengaduan::tambah'); // Halaman form tambah pengaduan
        $routes->post('tambah', 'Pengaduan::tambah_pengaduan'); // Proses tambah pengaduan
        $routes->get('ubah_pengaduan/(:num)', 'Pengaduan::ubah/$1');
        $routes->post('ubah_pengaduan/(:num)', 'Pengaduan::ubah_pengaduan/$1');
    });

    $routes->get('suratkuasa/', 'Masyarakat\SuratKuasaController::formMasyarakat');
    $routes->get('suratkuasa/detail/(:num)', 'Masyarakat\SuratKuasaController::detail/$1');
    $routes->get('suratkuasa/edit/(:num)', 'Masyarakat\SuratKuasaController::editForm/$1');
    $routes->post('suratkuasa/edit/(:num)', 'Masyarakat\SuratKuasaController::editProcess/$1');
    $routes->get('suratkuasa/riwayat', 'Masyarakat\SuratKuasaController::riwayat');
    $routes->post('suratkuasa/submitMasyarakat', 'Masyarakat\SuratKuasaController::submitMasyarakat');
    $routes->delete('suratkuasa/riwayat/(:num)', 'Masyarakat\SuratKuasaController::soft_delete/$1');
});

$routes->get('logout', 'AuthController::logout');


/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('notfound', 'Auth::notfound');


// // Halaman ubah password user (hanya bisa diakses setelah login)
// $routes->get('user/ubah-password', 'User::ubah_password', ['filter' => 'auth']);

// /*
//  * --------------------------------------------------------------------
//  * Additional Routing
//  * --------------------------------------------------------------------
//  *
//  * There will often be times that you need additional routing and you
//  * need it to be able to override any defaults in this file. Environment
//  * based routes is one such time. require() additional route files here
//  * to make that happen.
//  *
//  * You will have access to the $routes object within that file without
//  * needing to reload it.
//  */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
