<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->add('/', 'Home::index');
$routes->add('/login', 'Home::login');
$routes->add('/loginproses', 'Home::loginProses');
$routes->add('/logout', 'Home::logout');
$routes->add('/beranda', 'Beranda::index');
$routes->add('/peminjaman', 'Peminjaman::index');
$routes->add('/inventaris', 'Inventaris::index');
$routes->add('/inventaris/indextambah', 'Inventaris::indexTambah');
$routes->add('/inventaris/simpanalat', 'Inventaris::simpanAlat');
$routes->add('/inventaris/indexdetail/(:any)', 'Inventaris::indexDetail/$1');
$routes->add('/inventaris/indexupdate/(:any)', 'Inventaris::indexUpdate/$1');
$routes->add('/inventaris/updatealat', 'Inventaris::updateAlat');
$routes->add('/inventaris/deletealat/(:any)', 'Inventaris::deleteAlat/$1');
$routes->post('/barang/simpan', 'Barang::simpan');
$routes->add('/barang/index', 'Barang::index');
$routes->add('/barang/barangsesi', 'Barang::barangSesi');
$routes->add('/stok/indexdetail/(:any)', 'Stok::indexDetail/$1');
$routes->add('/stok/tambahbarang', 'Stok::tambahBarang');
$routes->add('/stok/indextambah', 'Stok::indexTambah');
$routes->add('/stok/indexupdate/(:any)', 'Stok::indexUpdate/$1');
$routes->add('/barang_tambah/index', 'Barang_Tambah::index');

$routes->post('/barang_masuk/savedata', 'Barang_Masuk::saveData');
$routes->add('/barang_masuk/cari', 'Barang_Masuk::index2');
$routes->add('/barang_masuk/index', 'Barang_Masuk::index');
$routes->add('/barang_masuk/clearsession', 'Barang_Masuk::clearSession');
$routes->add('/barang_masuk/update', 'Barang_Masuk::updateStok');
$routes->add('/barang_masuk/update2', 'Barang_Masuk::update');
$routes->add('/barang_masuk/carii', 'Barang_Masuk::cariStok');
$routes->add('/barang_masuk/deletemaster/(:any)', 'Barang_Masuk::deleteMaster/$1');

$routes->add('/barang_masuk/hapusitem', 'Barang_Masuk::hapusBarangDatalistMasuk');

$routes->add('/barang_keluar/index', 'Barang_Keluar::index');
$routes->post('/barang_keluar/savedata', 'Barang_Keluar::saveData');
$routes->add('/barang_keluar/cari', 'Barang_Keluar::index2');
$routes->add('/barang_keluar/clearsession', 'Barang_Keluar::clearSession');
$routes->add('/barang_keluar/update', 'Barang_Keluar::updateStok');
$routes->add('/barang_keluar/update2', 'Barang_Keluar::update');
$routes->add('/barang_keluar/carii', 'Barang_Keluar::cariStok');
$routes->add('/barang_keluar/hapusitem', 'Barang_Keluar::hapusBarangDatalistKeluar');
$routes->add('/barang_keluar/deletemaster/(:any)', 'Barang_keluar::deleteMaster/$1');

$routes->add('/beranda', 'Beranda::index');
$routes->add('/barang_masuk', 'Barang_Masuk::beranda');
$routes->add('/barang_masuk/beranda', 'Barang_Masuk::beranda');
$routes->add('/barang_keluar', 'Barang_Keluar::beranda');
$routes->add('/barang_pinjam', 'Barang_Pinjam::beranda');
$routes->add('/barang_pinjam/printd/(:any)', 'Barang_Pinjam::printd/$1');



$routes->add('/laporan_stok', 'Laporan_Stok::index');
$routes->add('/laporan_stok/exports', 'Laporan_Stok::exports');
$routes->add('/laporan_masuk', 'Laporan_Masuk::index');
$routes->add('/laporan_masuk/exportm', 'Laporan_Masuk::exportm');
$routes->add('/laporan_keluar', 'Laporan_Keluar::index');
$routes->add('/laporan_keluar/exportk', 'Laporan_Keluar::exportk');

$routes->add('/laporan_peminjaman', 'Laporan_Peminjaman::index');
$routes->add('/laporan_peminjaman/exportp', 'Laporan_Peminjaman::exportp');
$routes->add('/laporan_peminjaman/printp', 'Laporan_Peminjaman::printp');

$routes->add('/laporan_inventaris', 'Laporan_Inventaris::index');
$routes->add('/laporan_inventaris/exporti', 'Laporan_Inventaris::exporti');
$routes->add('/laporan_inventaris/printi', 'Laporan_Inventaris::printi');

$routes->add('/stok', 'Stok::index');
$routes->add('/stok/tambahbarang', 'Stok::tambahBarang');
$routes->add('/stok/updatebarang', 'Stok::updateBarang');
$routes->add('/stok/deletebarang/(:any)', 'Stok::deleteBarang/$1');

$routes->add('/satuan/deletesatuan/(:any)', 'Satuan::deleteSatuan/$1');
$routes->add('/satuan', 'Satuan::index');
$routes->add('/satuan/indextambah', 'Satuan::indexTambah');
$routes->add('/satuan/indexupdate/(:any)', 'Satuan::indexUpdate/$1');
$routes->add('/satuan/tambahsatuan', 'Satuan::tambahSatuan');
$routes->add('/satuan/updatesatuan', 'Satuan::updateSatuan');

$routes->add('/kategori/deletekategori/(:any)', 'Kategori::deleteKategori/$1');
$routes->add('/kategori', 'Kategori::index');
$routes->add('/kategori/indextambah', 'Kategori::indexTambah');
$routes->add('/kategori/indexupdate/(:any)', 'Kategori::indexUpdate/$1');
$routes->add('/kategori/tambahkategori', 'Kategori::tambahKategori');
$routes->add('/kategori/updatekategori', 'Kategori::updateKategori');

$routes->add('/penerima/deletepenerima/(:any)', 'Penerima::deletePenerima/$1');
$routes->add('/penerima', 'Penerima::index');
$routes->add('/penerima/indextambah', 'Penerima::indexTambah');
$routes->add('/penerima/indexupdate/(:any)', 'Penerima::indexUpdate/$1');
$routes->add('/penerima/tambahpenerima', 'Penerima::tambahPenerima');
$routes->add('/penerima/updatepenerima/(:any)', 'Penerima::updatePenerima/$1');

$routes->add('/supplier/deletesupplier/(:any)', 'Supplier::deletesupplier/$1');
$routes->add('/supplier', 'Supplier::index');
$routes->add('/supplier/indextambah', 'Supplier::indexTambah');
$routes->add('/supplier/indexupdate/(:any)', 'Supplier::indexUpdate/$1');
$routes->add('/supplier/tambahsupplier', 'Supplier::tambahSupplier');
$routes->add('/supplier/updatesupplier/(:any)', 'Supplier::updateSupplier/$1');


$routes->add('/laporan_stok/exports', 'Laporan_Stok::exports');

$routes->post('/barang_pinjam/savedata', 'Barang_Pinjam::saveData');
$routes->add('/barang_pinjam/cari', 'Barang_Pinjam::index2');
$routes->add('/barang_pinjam/updatestatus', 'Barang_Pinjam::updateStatus');
$routes->add('/barang_pinjam/index', 'Barang_Pinjam::index');
$routes->add('/barang_pinjam/clearsession', 'Barang_Pinjam::clearSession');
$routes->add('/barang_pinjam/update', 'Barang_Pinjam::updateStok');
$routes->add('/barang_pinjam/update2', 'Barang_Pinjam::update');
$routes->add('/barang_pinjam/carii', 'Barang_Pinjam::cariStok');
$routes->add('/barang_pinjam/hapusitem', 'Barang_Pinjam::hapusBarangDatalistPinjam');
$routes->add('/barang_pinjam/deletemaster/(:any)', 'Barang_pinjam::deleteMaster/$1');

$routes->add('/barang_masuk/indextambahbarang', 'Barang_Masuk::indexTambahBarang');
$routes->add('/barang_masuk/indextambahalat', 'Barang_Masuk::indexTambahAlat');
$routes->add('/barang_masuk/indexdetailmaster/(:any)', 'Barang_Masuk::indexDetailMaster/$1');
$routes->add('/stok/index2', 'Stok::index2');
$routes->add('/inventaris/index2', 'Inventaris::index2');
$routes->add('/barang_keluar/indexdetailmaster/(:any)', 'Barang_Keluar::indexDetailMaster/$1');
$routes->add('/barang_pinjam/indexdetailmaster/(:any)', 'Barang_Pinjam::indexDetailMaster/$1');

$routes->add('/laporan_keluar/printk', 'Laporan_Keluar::printk');
$routes->add('/laporan_masuk/printm', 'Laporan_Masuk::printm');
$routes->add('/laporan_stok/prints', 'Laporan_Stok::prints');

$routes->add('/user', 'User::index');
$routes->add('/user/create', 'User::create');
$routes->post('/user/store', 'User::store');
$routes->add('/user/edit/(:any)', 'User::edit/$1');
$routes->post('/user/update/(:any)', 'User::update/$1');
$routes->add('/user/delete/(:any)', 'User::delete/$1');
$routes->match(['add', 'post'], '/user/updatePassword/(:any)', 'User::updatePassword/$1');

$routes->add('/user/changePassword', 'UserController::changePasswordForm');
$routes->post('/user/updatePassword', 'UserController::updatePassword');

$routes->set404Override(function () {
    echo view('v_404');
});
