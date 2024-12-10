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
$routes->get('login', 'Login::index'); //Login Admin
// $routes->get('logout', 'Login::logout'); //Logout Admin
//Login User (Mahasiswa)
$routes->get('loginMhs', 'Login::loginMhs'); //Login Mahasiswa
$routes->post('Login/process', 'Login::process'); //Proses Login Mahasiswa
$routes->get('logoutM', 'Login::logoutM'); //Logout Mahasiswa

// Routes untuk Controller Register
// Register User (Mahasiswa)
$routes->get('registerMhs', 'Register::registerMhs'); //Halaman Register Mahasiswa
$routes->post('Register/add', 'Register::add'); //Menyimpan data register mahasiswa

//Routes untuk Controller PoinMarket_Admin
// Menampilkan Halaman Utama (Controller Admin)
$routes->get('/', 'PoinMarket_Admin\Admin::index',  ['filter' => 'login']);
$routes->get('/profile/(:num)', 'PoinMarket_Admin\Admin::profile/$1',  ['filter' => 'login']);


// Group untuk Controller User
$routes->group('User', ['filter' => 'login'], function ($routes) {
    $routes->get('', 'PoinMarket_Admin\User::index'); //Menampilkan halaman data user
});

// Group untuk Controller Mahasiswa
$routes->group('Mahasiswa', ['filter' => 'login'], function ($routes) {
    $routes->get('', 'PoinMarket_Admin\Mahasiswa::index'); //Menampilkan halaman data mahasiswa
    $routes->post('save_Mhs', 'PoinMarket_Admin\Mahasiswa::save_Mhs');
    $routes->post('update_Mhs/(:num)', 'PoinMarket_Admin\Mahasiswa::update_Mhs/$1');
    $routes->get('delete/(:num)', 'PoinMarket_Admin\Mahasiswa::delete/$1');
});

// Group untuk Controller Transaksi
$routes->group('Transaksi', ['filter' => 'login'], function ($routes) {
    // ['filter' => 'role:admin']
    $routes->get('', 'PoinMarket_Admin\Transaksi::index');
    $routes->get('reward', 'PoinMarket_Admin\Transaksi::reward');
    $routes->get('pembelian', 'PoinMarket_Admin\Transaksi::pembelian');
    $routes->get('punishment', 'PoinMarket_Admin\Transaksi::punishment');
    $routes->get('misi_tambah', 'PoinMarket_Admin\Transaksi::misi_tambah');
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

// Group Routes untuk Controller Badges
$routes->group('Badges', ['filter' => 'login'], function ($routes) {
    $routes->get('', 'PoinMarket_Admin\Badges::index');
    $routes->post('save_badges', 'PoinMarket_Admin\Badges::save_badges');
    $routes->post('update_badges/(:num)', 'PoinMarket_Admin\Badges::update_badges/$1');
    $routes->get('delete_badges/(:num)', 'PoinMarket_Admin\Badges::delete_badges/$1');
});

$routes->group('Validasi', ['filter' => 'login'], function ($routes) {
    $routes->get('', 'PoinMarket_Admin\Validasi::index');
    $routes->post('aksi/(:num)', 'PoinMarket_Admin\Validasi::validasiTransaksi/$1');
});

$routes->group('Jenis_Transaksi', ['filter' => 'login'], function ($routes) {
    // ['filter' => 'role:admin']
    $routes->get('reward', 'PoinMarket_Admin\Jenis_Transaksi::reward');
    $routes->get('pembelian', 'PoinMarket_Admin\Jenis_Transaksi::pembelian');
    $routes->get('punishment', 'PoinMarket_Admin\Jenis_Transaksi::punishment');
    $routes->get('misi_tambah', 'PoinMarket_Admin\Jenis_Transaksi::misi_tambah');
    $routes->post('save_Jenis', 'PoinMarket_Admin\Jenis_Transaksi::save_Jenis');
    $routes->post('update_Jenis/(:num)', 'PoinMarket_Admin\Jenis_Transaksi::update_Jenis/$1');
    $routes->get('delete_Jenis/(:num)', 'PoinMarket_Admin\Jenis_Transaksi::delete_Jenis/$1');
});

// Group untuk Controller Transaksi
$routes->group('Transaksi', ['filter' => 'login'], function ($routes) {
    // ['filter' => 'role:admin']
    $routes->get('reward', 'Transaksi::reward');
    $routes->get('pembelian', 'Transaksi::pembelian');
    $routes->get('punishment', 'Transaksi::punishment');
    $routes->get('misi_tambah', 'Transaksi::misi_tambah');
    $routes->get('transaksi_reward', 'Transaksi::transaksi_reward');
    $routes->get('transaksi_pembelian', 'Transaksi::transaksi_pembelian');
    $routes->get('transaksi_punishment', 'Transaksi::transaksi_punishment');
    $routes->get('transaksi_misi_tambah', 'Transaksi::transaksi_misi_tambah');
    $routes->get('validasi', 'Transaksi::validasi');
    $routes->get('data_transaksi', 'Transaksi::data_transaksi');
    $routes->get('data_misitambah', 'Transaksi::data_misitambah');
    // $routes->post('save_transaksi', 'Transaksi::save_transaksi');
    // $routes->post('save_dataTransaksi', 'Transaksi::save_dataTransaksi', ['filter' => 'role:admin']);
    // $routes->post('update_transaksi/(:num)', 'Transaksi::update_transaksi/$1');
    // $routes->post('update_data_transaksi/(:num)', 'Transaksi::update_data_transaksi/$1');
    // $routes->get('delete/(:num)', 'Transaksi::delete/$1');
    // $routes->get('delete_data/(:num)', 'Transaksi::delete_data/$1');
});



// Group untuk Controller Admin
$routes->group('Admin', ['filter' => 'login'], function ($routes) {
    $routes->get('market_place', 'Market_Place::market');
});

// Group untuk Controller Mahasiswa
$routes->group('Role_User', ['filter' => 'login_m'], function ($routes) {
    $routes->get('', 'Role_User::index');
    $routes->get('profile', 'Role_User::detail');
    $routes->post('save_email', 'Role_User::save_email');
    $routes->post('Update_Profile', 'Role_User::Update_Profile');
    $routes->get('data_transaksi', 'Role_User::data_transaksi');
    $routes->get('badges', 'Role_User::badges');
    $routes->get('reward', 'Role_User::reward');
    $routes->get('pembelian', 'Role_User::pembelian');
    $routes->get('punishment', 'Role_User::punishment');
    $routes->get('misi_tambahan', 'Role_User::misi');
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
