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

$routes->get('/', 'UserController::login');

# Login Route
$routes->match(['get', 'post'], 'login', 'UserController::login', ["filter" => "noauth"]);

// admin | 1
$routes->group("admin", ["filter" => "auth"], function ($routes) {
    # admin
    $routes->get("/", "AdminController::index");

    # user akun
    $routes->get("user", "UserAccountController::index");
    $routes->get("user/add", "UserAccountController::add");
    $routes->post("user/insert", "UserAccountController::insert");
    $routes->get('user/edit/(:any)', 'UserAccountController::edit/$1');

    # control absensi
    $routes->get("kinerja-pegawai", "AdminController::kinerja");
    $routes->get("laporan-pegawai", "AdminController::laporanPegawai");
    $routes->match(['get', 'post'], 'absensi/dataLapPegawai', 'AdminController::dataLapPegawai');
    $routes->match(['get', 'post'], 'absensi/dataLapPegawaiPdf', 'AdminController::printbyId');
    $routes->match(['get', 'post'], 'absensi/dataLapPegawaiExcel', 'AdminController::exportExcel');
});

# Pegawai
# example: in link href="pegawai/daftarp"
$routes->group("pegawai", ["filter" => "auth"], function ($routes) {

    # Pegawai
    $routes->get("/", "PegawaiController::index"); //dashboar pegawai
    $routes->get("daftarp", "PegawaiController::pegawai");

    # profile
    $routes->get("profil", "ProfilController::index");
    $routes->post("profil/update", "ProfilController::update");
    $routes->post("profil/updateImg", "ProfilController::updateImg");

    # absensi
    $routes->match(['get', 'post'], 'absensi', 'AbsensiController::index');
    $routes->get('absensi/absen', 'AbsensiController::absen');
    $routes->match(['get', 'post'], 'absensi/insertIn', 'AbsensiController::insertIn');
    $routes->match(['get', 'post'], 'absensi/insertOut', 'AbsensiController::insertOut');

    # izin
    $routes->post('izin/add', 'AbsensiController::add');
    $routes->match(['get', 'post'], 'izin/upd', 'AbsensiController::upd');
    $routes->post('izin/edit/(:num)', 'AbsensiController::edit/$1');
    $routes->match(['get', 'post'], 'Izin/delete', 'AbsensiController::delete');

    # laporan Absensi
    $routes->match(['get', 'post'], 'absensi/lembar-absensi', 'AbsensiController::lembarAbsensi');
    $routes->get('absensi/lembar-absensi/viewDetailAbsensi/(:any)', 'AbsensiController::viewDetailAbsensi/$1');
    $routes->match(['get', 'post'], 'absensi/hari-kerja', 'AbsensiController::hariKerja');
    $routes->match(['get', 'post'], 'absensi/dataHariKerja', 'AbsensiController::dataHariKerja');
    $routes->match(['get', 'post'], 'absensi/dataTables', 'AbsensiController::dataTables');
    $routes->match(['get', 'post'], 'absensi/laporan', 'AbsensiController::lap');
    $routes->match(['get', 'post'], 'absensi/dataLap', 'AbsensiController::dataLap');
    $routes->get('absensi/pdf-laporan', 'AbsensiController::printbyId');
    # info menu
    $routes->match(['get', 'post'], 'info', 'InfoController::index');
});

# logout
$routes->get('logout', 'UserController::logout');

# Cron Job (Otomatis absen alpa/tidak hadir)
$routes->cli('task', 'TaskController::index');

# ./ Login Route
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
