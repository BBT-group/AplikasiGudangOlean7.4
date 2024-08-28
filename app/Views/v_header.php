<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/logo.png">

    <title><?php echo session()->get('role') ?> | Gudang PT.Olean</title>

    <!-- Custom fonts for this template-->
    <link href="/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/css/sb-admin-2.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.css" />

    <!-- Custom styles for this page -->
    <link href="/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.css">
    
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <style>
        .collapse-item.active {
            color: #27468B !important;
            background-color: #fff !important;
            /* Hijau */
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion <?= uri_string() == 'beranda' ? 'active' : '' ?>" id="accordionSidebar" style="background-color: #27468B;">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('beranda') ?>">
                <div class="sidebar-brand-icon">
                    <img src="/img/logo.png" style="height: 50px;">
                </div>
                <div class="sidebar-brand-text mx-3">PT. OLEAN</div>
            </a>
            <hr class="sidebar-divider my-0">
            <?php if (session()->role == 'admin') : ?>
                <li class="nav-item <?= uri_string() == 'beranda' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?php echo base_url('beranda') ?>">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <hr class="sidebar-divider">
                <div class="sidebar-heading">Master</div>
                <li class="nav-item <?= in_array(uri_string(), ['stok', 'kategori', 'satuan']) ? 'active' : '' ?>">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-layer-group"></i>
                        <span>Stok Barang</span>
                    </a>
                    <div id="collapseTwo" class="collapse <?= in_array(uri_string(), ['stok', 'kategori', 'satuan']) ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item <?= uri_string() == 'stok' ? 'active' : '' ?>" href="<?php echo base_url('stok') ?>">Data Barang</a>
                            <a class="collapse-item <?= uri_string() == 'kategori' ? 'active' : '' ?>" href="<?php echo base_url('kategori') ?>">Kategori</a>
                            <a class="collapse-item <?= uri_string() == 'satuan' ? 'active' : '' ?>" href="<?php echo base_url('satuan') ?>">Satuan</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item <?= uri_string() == 'inventaris' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?php echo base_url('inventaris') ?>">
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>Inventaris Alat</span>
                    </a>
                </li>
                <hr class="sidebar-divider">
                <div class="sidebar-heading">Transaksi</div>
                <li class="nav-item <?= uri_string() == 'barang_masuk' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?php echo base_url('barang_masuk') ?>">
                        <i class="fas fa-fw fa-sign-in-alt"></i>
                        <span>Barang Masuk</span>
                    </a>
                </li>
                <hr class="sidebar-divider">
                <div class="sidebar-heading">Laporan</div>
                <li class="nav-item <?= in_array(uri_string(), ['laporan_stok', 'laporan_inventaris']) ? 'active' : '' ?>">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="fas fa-fw fa-file-signature"></i>
                        <span>Laporan Stok</span>
                    </a>
                    <div id="collapseOne" class="collapse <?= in_array(uri_string(), ['laporan_stok', 'laporan_inventaris']) ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item <?= uri_string() == 'laporan_stok' ? 'active' : '' ?>" href="<?php echo base_url('laporan_stok') ?>">Stok Barang</a>
                            <a class="collapse-item <?= uri_string() == 'laporan_inventaris' ? 'active' : '' ?>" href="<?php echo base_url('laporan_inventaris') ?>">Stok Alat</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item <?= uri_string() == 'laporan_masuk' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?php echo base_url('laporan_masuk') ?>">
                        <i class="fas fa-fw fa-file-import"></i>
                        <span>Laporan Barang Masuk</span>
                    </a>
                </li>
                <li class="nav-item <?= uri_string() == 'laporan_keluar' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?php echo base_url('laporan_keluar') ?>">
                        <i class="fas fa-fw fa-file-export"></i>
                        <span>Laporan Barang Keluar</span>
                    </a>
                </li>
                <li class="nav-item <?= uri_string() == 'laporan_peminjaman' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?php echo base_url('laporan_peminjaman') ?>">
                        <i class="fas fa-fw fa-file-export"></i>
                        <span>Laporan Peminjaman</span>
                    </a>
                </li>
                <hr class="sidebar-divider d-none d-md-block">

                <div class="sidebar-heading">
                    Akun
                </div>
                <li class="nav-item <?= uri_string() == 'user' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?php echo base_url('user') ?>">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Manajemen Akun</span></a>
                </li>

                <hr class="sidebar-divider">

            <?php endif; ?>
            <?php if (session()->role == 'operator') : ?>
                <li class="nav-item <?= uri_string() == 'beranda' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?php echo base_url('beranda') ?>">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <hr class="sidebar-divider">
                <div class="sidebar-heading">Master</div>
                <li class="nav-item <?= uri_string() == 'stok' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?php echo base_url('stok') ?>">
                        <i class="fas fa-fw fa-layer-group"></i>
                        <span>Data Barang</span>
                    </a>
                </li>
                <li class="nav-item <?= uri_string() == 'inventaris' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?php echo base_url('inventaris') ?>">
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>Inventaris Alat</span>
                    </a>
                </li>
                <hr class="sidebar-divider">
                <div class="sidebar-heading">Transaksi</div>
                <li class="nav-item <?= uri_string() == 'barang_keluar' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?php echo base_url('barang_keluar') ?>">
                        <i class="fas fa-fw fa-sign-out-alt"></i>
                        <span>Barang Keluar</span>
                    </a>
                </li>
                <li class="nav-item <?= uri_string() == 'barang_pinjam' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?php echo base_url('barang_pinjam') ?>">
                        <i class="fas fa-fw fa-sign-out-alt"></i>
                        <span>Barang Pinjam</span>
                    </a>
                </li>
                <hr class="sidebar-divider d-none d-md-block">
                <div class="sidebar-heading">
                    Laporan
                </div>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('laporan_keluar') ?>">
                        <i class="fas fa-fw fa-file-export"></i>
                        <span>Laporan Barang Keluar</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('laporan_peminjaman') ?>">
                        <i class="fas fa-fw fa-file-export"></i>
                        <span>Laporan Peminjaman</span></a>
                </li>
            <?php endif; ?>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-2 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3" style="color: #27468B;">
                        <i class="fa fa-bars"></i>
                    </button>
                    <div class="text-center d-none d-md-inline" style="color: #fff;">
                        <button class="rounded-circle border-0" id="sidebarToggle" style="background-color: #fff;">
                            <i class="fa fa-bars" style="color: #27468B;"></i>
                        </button>
                    </div>
                    <h1 class="h3 mb-2 text-gray-800 pl-3"><?php
                            $uri = uri_string();
                            if ($uri == 'beranda') {
                                echo 'Dashboard';
                            } elseif ($uri == 'stok') {
                                echo 'Stok Barang';
                            } elseif ($uri == 'kategori') {
                                echo 'Kategori Barang';
                            } elseif ($uri == 'satuan') {
                                echo 'Satuan Barang';
                            } elseif ($uri == 'inventaris') {
                                echo 'Stok Alat';
                            } elseif ($uri == 'barang_masuk') {
                                echo 'Barang Masuk';
                            } elseif ($uri == 'laporan_stok') {
                                echo 'Laporan Stok Barang';
                            } elseif ($uri == 'laporan_inventaris') {
                                echo 'Laporan Stok Alat';
                            } elseif ($uri == 'laporan_masuk') {
                                echo 'Laporan Barang Masuk';
                            } elseif ($uri == 'laporan_keluar') {
                                echo 'Laporan Barang Keluar';
                            } elseif ($uri == 'laporan_peminjaman') {
                                echo 'Laporan Peminjaman';
                            } elseif ($uri == 'user') {
                                echo 'Manajemen Akun';
                            } elseif ($uri == 'password') {
                                echo 'Ganti Password';
                            } elseif ($uri == 'barang_keluar') {
                                echo 'Barang Keluar';
                            } elseif ($uri == 'peminjaman') {
                                echo 'Peminjaman Alat';
                            } elseif ($uri == 'pengembalian') {
                                echo 'Pengembalian Alat';
                            } elseif ($uri == 'barang_pinjam') {
                                echo 'Barang Pinjam';
                            } elseif ($uri == 'barang_pinjam/index' || $uri == 'barang_keluar/index'|| $uri == 'barang_masuk/index') {
                                echo 'Inventory Management';
                            } elseif ($uri == 'barang_pinjam/cari' || $uri == 'barang_keluar/cari'|| $uri == 'barang_masuk/cari') {
                                echo 'Cari Barang';
                            } elseif ($uri == 'stok/indextambah' || $uri == 'inventaris/indextambah') {
                                echo 'Tambah Data';
                            } elseif ($uri == 'stok/indexupdate/(:num)' || $uri == 'inventaris/indexupdate/(:num)') {
                                echo 'Update Data';
                            } else {
                                echo 'Gudang PT.Olean';
                            }
                            ?></h1>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-lg-inline text-gray-600 small">Hallo, <?php echo session()->get('nama') ?></span>
                                <img class="img-profile rounded-circle" src="/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                    <!-- Logout Modal-->
                    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin Ingin Keluar?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">Pilih "Logout" di bawah ini jika Anda siap untuk keluar dari website gudang olean.</div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    <a class="btn btn-primary" href="<?php echo base_url('logout') ?>">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </nav>
                <!-- End of Topbar -->