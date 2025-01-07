<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Login::index');

$routes->group('page', function ($routes) {
    $routes->get('', 'LandingPage::index');
    $routes->get('gamifikasi', 'LandingPage::gamifikasi');
    $routes->get('gaya_belajar', 'LandingPage::gaya_belajar');
    $routes->get('register', 'LandingPage::register');
});

// Group untuk Controller Admin
$routes->group('Admin', ['filter' => 'login'], function ($routes) {
    $routes->get('market_place', 'Market_Place::market');
});

$routes->get('learning', 'Learning::index');

//Memilih Page Login & Landing Page
$routes->get('pilih', 'LandingPage::pilih');
$routes->get('Landing', 'LandingPage::page');
$routes->get('Landing1', 'LandingPage::page1');
$routes->get('Landing2', 'LandingPage::page2');
$routes->get('Landing3', 'LandingPage::page3');
$routes->get('Landing4', 'LandingPage::page4');
$routes->get('Landing5', 'LandingPage::page5');

$routes->get('tespage', 'LandingPage::tes');
$routes->get('tespage1', 'LandingPage::tes1');
$routes->get('tespage2', 'LandingPage::tes2');
$routes->get('tespage3', 'LandingPage::tes3');
$routes->get('tespage4', 'LandingPage::tes4');
$routes->get('tespage5', 'LandingPage::tes5');
// Menampilkan halaman utama (dengan Filter Login)
// $routes->get('/', 'Admin::index',  ['filter' => 'login']);
$routes->get('Login/detail', 'Login::detail'); // Menampilkan profil User (Admin/Mahasiswa yang sedang Login)

// Routes Untuk Controller Login
// Login User (Admin)
$routes->get('login', 'Login::login');
// $routes->get('login', 'Login::index'); //Login Admin
// $routes->get('logout', 'Login::logout'); //Logout Admin

//Login User (Mahasiswa)
$routes->get('loginMhs', 'Login::loginMs'); //Login Mahasiswa
// $routes->get('loginMhs', 'Login::loginMhs'); //Login Mahasiswa
$routes->post('Login/process', 'Login::process'); //Proses Login Mahasiswa
$routes->get('logoutM', 'Login::logoutM'); //Logout Mahasiswa Ketika logout tambahkan agar session terhapus

// Register User (Mahasiswa)
$routes->get('registerMhs', 'Register::registerMhs'); //Halaman Register Mahasiswa
$routes->post('Register/add', 'Register::add'); //Menyimpan data register mahasiswa

// Menampilkan Halaman Utama (Controller Admin)
$routes->get('/dashboard', 'PoinMarket_Admin\Admin::index',  ['filter' => 'login']);
$routes->get('/', 'LandingPage::index');
// $routes->get('/', 'PoinMarket_Admin\Admin::index',  ['filter' => 'login']);
$routes->get('/profile/(:num)', 'PoinMarket_Admin\Admin::profile/$1',  ['filter' => 'login']);


// Group untuk Controller User
$routes->group('User', ['filter' => 'login'], function ($routes) {
    $routes->get('', 'PoinMarket_Admin\User::index'); //Menampilkan halaman data user
    $routes->post('save_Users', 'PoinMarket_Admin\User::save_Users');
    $routes->get('delete_User/(:num)', 'PoinMarket_Admin\User::delete_User/$1');
});

// Group untuk Controller Mahasiswa
$routes->group('Mahasiswa', ['filter' => 'login'], function ($routes) {
    $routes->get('', 'PoinMarket_Admin\Mahasiswa::index'); //Menampilkan halaman data mahasiswa
    $routes->post('save_Mhs', 'PoinMarket_Admin\Mahasiswa::save_Mhs');
    $routes->post('update_Mhs/(:num)', 'PoinMarket_Admin\Mahasiswa::update_Mhs/$1');
    $routes->get('delete/(:num)', 'PoinMarket_Admin\Mahasiswa::delete/$1');
});

// Controller Jenis Transaksi
$routes->group('Jenis_Transaksi', ['filter' => 'login'], function ($routes) {
    // ['filter' => 'role:admin']
    $routes->get('', 'PoinMarket_Admin\Jenis_Transaksi::all');
    $routes->get('reward', 'PoinMarket_Admin\Jenis_Transaksi::reward');
    $routes->get('pembelian', 'PoinMarket_Admin\Jenis_Transaksi::pembelian');
    $routes->get('punishment', 'PoinMarket_Admin\Jenis_Transaksi::punishment');
    $routes->get('misi_tambah', 'PoinMarket_Admin\Jenis_Transaksi::misi_tambah');
    $routes->get('konsultasi', 'PoinMarket_Admin\Jenis_Transaksi::konsultasi');
    $routes->post('save_Jenis', 'PoinMarket_Admin\Jenis_Transaksi::save_Jenis');
    $routes->post('update_Jenis/(:num)', 'PoinMarket_Admin\Jenis_Transaksi::update_Jenis/$1');
    $routes->get('delete/(:num)', 'PoinMarket_Admin\Jenis_Transaksi::delete_Jenis/$1');
});

// Group Routes untuk Controller Badges
$routes->group('Badges', ['filter' => 'login'], function ($routes) {
    $routes->get('', 'PoinMarket_Admin\Badges::index');
    $routes->post('save_badges', 'PoinMarket_Admin\Badges::save_badges');
    $routes->post('update_badges/(:num)', 'PoinMarket_Admin\Badges::update_badges/$1');
    $routes->get('delete_badges/(:num)', 'PoinMarket_Admin\Badges::delete_badges/$1');
});

// Group untuk Controller Transaksi (Data Transaksi)
$routes->group('Transaksi', ['filter' => 'login'], function ($routes) {
    // ['filter' => 'role:admin']
    $routes->get('', 'PoinMarket_Admin\Transaksi::index');
    $routes->get('reward', 'PoinMarket_Admin\Transaksi::reward');
    $routes->get('pembelian', 'PoinMarket_Admin\Transaksi::pembelian');
    $routes->get('punishment', 'PoinMarket_Admin\Transaksi::punishment');
    $routes->get('misi_tambah', 'PoinMarket_Admin\Transaksi::misi_tambah');
    $routes->get('konsultasi', 'PoinMarket_Admin\Transaksi::konsultasi');
    $routes->post('save_Transaksi', 'PoinMarket_Admin\Transaksi::save_Transaksi');
    $routes->post('update_transaksi/(:num)', 'PoinMarket_Admin\Transaksi::update_Transaksi/$1');
    $routes->get('delete_Transaksi/(:num)', 'PoinMarket_Admin\Transaksi::delete_Transaksi/$1');
});

// Group untuk Controller Misi_Tambah
$routes->group('Misi_tambah', ['filter' => 'login'], function ($routes) {
    // ['filter' => 'role:admin']
    $routes->get('', 'PoinMarket_Admin\Misi_tambah::index');
    $routes->post('save_Misi', 'PoinMarket_Admin\Misi_tambah::save_Misi');
    $routes->post('update_Misi/(:num)', 'PoinMarket_Admin\Misi_tambah::update_Misi/$1');
    $routes->get('delete_Misi/(:num)', 'PoinMarket_Admin\Misi_tambah::delete_Misi/$1');
});

// Controller Quis
$routes->group('Quis', ['filter' => 'login'], function ($routes) {
    $routes->get('', 'PoinMarket_Admin\Quis::index');
    $routes->post('simpanQuis', 'PoinMarket_Admin\Quis::simpanpertanyaan');
    $routes->post('updateQuis/(:num)', 'PoinMarket_Admin\Quis::updateQuis/$1');
    $routes->get('delete/(:num)', 'PoinMarket_Admin\Quis::hapus/$1');
});

// Controller Validasi
$routes->group('Validasi', ['filter' => 'login'], function ($routes) {
    $routes->get('', 'PoinMarket_Admin\Validasi::index');
    $routes->post('aksi/(:num)', 'PoinMarket_Admin\Validasi::validasiTransaksi/$1');
});



// Group untuk Controller Mahasiswa
$routes->group('Role_User', ['filter' => 'login_m'], function ($routes) {
    $routes->get('', 'Role_User::index');
    $routes->get('profile', 'Role_User::detail');
    $routes->post('save_email', 'Role_User::save_email');
    $routes->post('change_password', 'Role_User::change_password');
    $routes->post('Update_Profile', 'Role_User::Update_Profile');
    $routes->get('data_transaksi', 'Role_User::data_transaksi');
    $routes->post('save_Transaksi', 'Role_User::save_Transaksi');
    $routes->get('badges', 'Role_User::badges');
    $routes->get('reward', 'Role_User::reward');
    $routes->get('pembelian', 'Role_User::pembelian');
    $routes->get('punishment', 'Role_User::punishment');
    $routes->get('misi_tambahan', 'Role_User::misi');
    $routes->get('konsultasi', 'Role_User::konsultasi');
    $routes->get('misi', 'Role_User::misi_tambah');
    $routes->get('market', 'Marketplace::index'); // Menampilkan halaman utama marketplace
    $routes->post('market/buy', 'Marketplace::buy'); // Proses pembelian
    $routes->post('market/reward', 'Marketplace::reward'); // Proses reward
    $routes->post('market/claim', 'Marketplace::claimReward'); // Proses reward
    $routes->post('market/punishment', 'Marketplace::punishment'); // Proses punishment
    $routes->post('market/misi_tambah', 'Marketplace::misi_tambah'); // Proses misi tambahan
    $routes->get('quis', 'Marketplace::quis');
    $routes->post('submitQuiz', 'Marketplace::submitQuiz');
    $routes->post('kirimJawaban', 'Marketplace::kirimJawaban');
});

// MarketPlace tanpa Login
$routes->get('market', 'Marketplace::index'); // Menampilkan halaman utama marketplace
$routes->post('market/buy', 'Marketplace::buy'); // Proses pembelian
$routes->post('market/misi', 'Marketplace::misi_tambah'); // Proses pembelian

// Content Management System
$routes->group('cms',  function ($routes) {
    $routes->get('', 'CMS::index');
    $routes->get('view/(:num)', 'CMS::view/$1');
    $routes->get('create', 'CMS::create');
    $routes->post('store', 'CMS::store');
    $routes->get('edit/(:num)', 'CMS::edit/$1');
    $routes->post('update/(:num)', 'CMS::update/$1');
    $routes->get('delete/(:num)', 'CMS::delete/$1');
});

// Routes untuk API
$routes->group('api', function ($routes) {
    // $routes->get('transaksi', 'PoinMarket_Admin\Validasi::getAllTransaksi');
    // $routes->post('transaksi/validasi/(:num)', 'PoinMarket_Admin\Validasi::validateTransaksi/$1');
    // API User
    $routes->get('user', 'API\UserAPI::index'); //Mengambil semua data
    $routes->get('user/(:num)', 'API\UserAPI::show/$1'); //Mengambil data berdasarkan id
    // API JenisTransaksi (Data Nama Transaksi)
    $routes->get('jenis_transaksi', 'API\JenisTransaksiAPI::index'); //Mengambil semua data
    $routes->get('jenis_transaksi/(:num)', 'API\JenisTransaksiAPI::show/$1'); //Mengambil data berdasarkan id
    // API Transaksi (Data Transaksi Mahasiswa)
    $routes->get('transaksi', 'API\TransaksiAPI::index'); //Mengambil semua data
    $routes->get('transaksi/(:num)', 'API\TransaksiAPI::show/$1'); //Mengambil data berdasarkan id
    // API Badges
    $routes->get('badges', 'API\BadgesAPI::index'); //Mengambil semua data
    $routes->get('badges/(:num)', 'API\BadgesAPI::show/$1'); //Mengambil data berdasarkan id
    // API Mahasiswa
    $routes->get('mahasiswa', 'API\MahasiswaAPI::index'); //Mengambil semua data
    $routes->get('mahasiswa/(:num)', 'API\MahasiswaAPI::show/$1'); //Mengambil data berdasarkan id
    $routes->post('mahasiswa', 'API\MahasiswaAPI::create'); //Menambahkan data
    $routes->put('mahasiswa/(:num)', 'API\MahasiswaAPI::update/$1'); //Mengedit data
    $routes->delete('mahasiswa/(:num)', 'API\MahasiswaAPI::delete/$1'); //Menghapus data
});


// $routes->get('notification', 'Message::showSweet');

// $routes->get('home', 'Home::index');
// $routes->get('home/scan', 'Home::scan');
// $routes->get('home/add', 'Home::add');
// $routes->post('home/save', 'Home::save');



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
