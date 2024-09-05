<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->add('/login', 'Home::login');
$routes->add('/loginproses', 'Home::loginProses');
$routes->get('/logout', 'Home::logout');
$routes->get('/beranda', 'Beranda::index');
$routes->get('/peminjaman', 'Peminjaman::index');
$routes->add('/inventaris', 'Inventaris::index');
$routes->get('/inventaris/indextambah', 'Inventaris::indexTambah');
$routes->add('/inventaris/simpanalat', 'Inventaris::simpanAlat');
$routes->add('/inventaris/indexdetail/(:num)', 'Inventaris::indexDetail/$1');
$routes->add('/inventaris/indexupdate/(:num)', 'Inventaris::indexUpdate/$1');
$routes->add('/inventaris/updatealat', 'Inventaris::updateAlat');
$routes->get('/inventaris/deletealat/(:num)', 'Inventaris::deleteAlat/$1');
$routes->post('/barang/simpan', 'Barang::simpan');
$routes->add('/barang/index', 'Barang::index');
$routes->add('/barang/barangsesi', 'Barang::barangSesi');
$routes->add('/stok/indexdetail/(:num)', 'Stok::indexDetail/$1');
$routes->add('/stok/tambahbarang', 'Stok::tambahBarang');
$routes->add('/stok/indextambah', 'Stok::indexTambah');
$routes->add('/stok/indexupdate/(:num)', 'Stok::indexUpdate/$1');
$routes->add('/barang_tambah/index', 'Barang_Tambah::index');

$routes->post('/barang_masuk/savedata', 'Barang_Masuk::saveData');
$routes->add('/barang_masuk/cari', 'Barang_Masuk::index2');
$routes->add('/barang_masuk/index', 'Barang_Masuk::index');
$routes->add('/barang_masuk/clearsession', 'Barang_Masuk::clearSession');
$routes->add('/barang_masuk/update', 'Barang_Masuk::updateStok');
$routes->add('/barang_masuk/update2', 'Barang_Masuk::update');
$routes->add('/barang_masuk/carii', 'Barang_Masuk::cariStok');
$routes->add('/barang_masuk/hapusitem', 'Barang_Masuk::hapusBarangDatalistMasuk');

$routes->add('/barang_keluar/index', 'Barang_Keluar::index');
$routes->post('/barang_keluar/savedata', 'Barang_Keluar::saveData');
$routes->add('/barang_keluar/cari', 'Barang_Keluar::index2');
$routes->add('/barang_keluar/clearsession', 'Barang_Keluar::clearSession');
$routes->add('/barang_keluar/update', 'Barang_Keluar::updateStok');
$routes->add('/barang_keluar/update2', 'Barang_Keluar::update');
$routes->add('/barang_keluar/carii', 'Barang_Keluar::cariStok');
$routes->add('/barang_keluar/hapusitem', 'Barang_Keluar::hapusBarangDatalistKeluar');

$routes->get('/beranda', 'Beranda::index');
$routes->get('/barang_masuk', 'Barang_Masuk::beranda');
$routes->get('/barang_masuk/beranda', 'Barang_Masuk::beranda');
$routes->get('/barang_keluar', 'Barang_Keluar::beranda');
$routes->get('/barang_pinjam', 'Barang_Pinjam::beranda');
$routes->get('/laporan_stok', 'Laporan_Stok::index');
$routes->get('/laporan_stok/exports', 'Laporan_Stok::exports');
$routes->get('/laporan_masuk', 'Laporan_Masuk::index');
$routes->get('/laporan_masuk/exportm', 'Laporan_Masuk::exportm');
$routes->get('/laporan_keluar', 'Laporan_Keluar::index');
$routes->get('/laporan_keluar/exportk', 'Laporan_Keluar::exportk');

$routes->get('/laporan_peminjaman', 'Laporan_Peminjaman::index');
$routes->get('/laporan_peminjaman/exportp', 'Laporan_Peminjaman::exportp');
$routes->get('/laporan_peminjaman/printp', 'Laporan_Peminjaman::printp');

$routes->get('/laporan_inventaris', 'Laporan_Inventaris::index');
$routes->get('/laporan_inventaris/exporti', 'Laporan_Inventaris::exporti');
$routes->get('/laporan_inventaris/printi', 'Laporan_Inventaris::printi');

$routes->get('/stok', 'Stok::index');
$routes->get('/stok/tambahbarang', 'Stok::tambahBarang');
$routes->add('/stok/updatebarang', 'Stok::updateBarang');
$routes->get('/stok/deletebarang/(:num)', 'Stok::deleteBarang/$1');

$routes->get('/satuan/deletesatuan/(:num)', 'Satuan::deleteSatuan/$1');
$routes->get('/satuan', 'Satuan::index');
$routes->add('/satuan/indextambah', 'Satuan::indexTambah');
$routes->add('/satuan/indexupdate/(:num)', 'Satuan::indexUpdate/$1');
$routes->add('/satuan/tambahsatuan', 'Satuan::tambahSatuan');
$routes->add('/satuan/updatesatuan', 'Satuan::updateSatuan');

$routes->get('/kategori/deletekategori/(:num)', 'Kategori::deleteKategori/$1');
$routes->get('/kategori', 'Kategori::index');
$routes->add('/kategori/indextambah', 'Kategori::indexTambah');
$routes->add('/kategori/indexupdate/(:num)', 'Kategori::indexUpdate/$1');
$routes->add('/kategori/tambahkategori', 'Kategori::tambahKategori');
$routes->add('/kategori/updatekategori', 'Kategori::updateKategori');


$routes->get('/laporan_stok/exports', 'Laporan_Stok::exports');

$routes->post('/barang_pinjam/savedata', 'Barang_Pinjam::saveData');
$routes->add('/barang_pinjam/cari', 'Barang_Pinjam::index2');
$routes->add('/barang_pinjam/updatestatus', 'Barang_Pinjam::updateStatus');
$routes->add('/barang_pinjam/index', 'Barang_Pinjam::index');
$routes->add('/barang_pinjam/clearsession', 'Barang_Pinjam::clearSession');
$routes->add('/barang_pinjam/update', 'Barang_Pinjam::updateStok');
$routes->add('/barang_pinjam/update2', 'Barang_Pinjam::update');
$routes->add('/barang_pinjam/carii', 'Barang_Pinjam::cariStok');
$routes->add('/barang_pinjam/hapusitem', 'Barang_Pinjam::hapusBarangDatalistPinjam');

$routes->add('/barang_masuk/indextambahbarang', 'Barang_Masuk::indexTambahBarang');
$routes->add('/barang_masuk/indextambahalat', 'Barang_Masuk::indexTambahAlat');
$routes->add('/barang_masuk/indexdetailmaster/(:num)', 'Barang_Masuk::indexDetailMaster/$1');
$routes->add('/stok/index2', 'Stok::index2');
$routes->add('/inventaris/index2', 'Inventaris::index2');
$routes->add('/barang_keluar/indexdetailmaster/(:num)', 'Barang_Keluar::indexDetailMaster/$1');
$routes->add('/barang_pinjam/indexdetailmaster/(:num)', 'Barang_Pinjam::indexDetailMaster/$1');

$routes->add('/laporan_keluar/printk', 'Laporan_Keluar::printk');
$routes->add('/laporan_masuk/printm', 'Laporan_Masuk::printm');
$routes->add('/laporan_stok/prints', 'Laporan_Stok::prints');

$routes->get('/user', 'User::index');
$routes->get('/user/create', 'User::create');
$routes->post('/user/store', 'User::store');
$routes->get('/user/edit/(:num)', 'User::edit/$1');
$routes->post('/user/update/(:num)', 'User::update/$1');
$routes->get('/user/delete/(:num)', 'User::delete/$1');
$routes->match(['get', 'post'], '/user/updatePassword/(:num)', 'User::updatePassword/$1');

$routes->get('/user/changePassword', 'UserController::changePasswordForm');
$routes->post('/user/updatePassword', 'UserController::updatePassword');

$routes->set404Override(function () {
    echo view('v_404');
});
