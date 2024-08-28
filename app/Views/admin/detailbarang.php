                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <!-- judul form -->
                                    <div class="card-title">Detail Data Barang</div>
                                </div>
                                <!-- detail data -->
                                <div class="card-body" >
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td width="120">ID Barang</td>
                                                <td width="10">:</td>
                                                <td style="background-color: #f2f2f2; color: gray;"><?= $data['id_barang'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Nama Barang</td>
                                                <td>:</td>
                                                <td style="color: gray;"><?= $data['nama'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Stok</td>
                                                <td>:</td>
                                                <td style="background-color: #f2f2f2; color: gray;"><?= $data['stok'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Satuan</td>
                                                <td>:</td>
                                                <td style="color: gray;" ><?= $data['nama_satuan'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Kategori</td>
                                                <td>:</td>
                                                <td style="background-color: #f2f2f2; color: gray;"><?= $data['nama_kategori'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Harga Beli</td>
                                                <td>:</td>
                                                <td style="color: gray;"><?= $data['harga_beli'] ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <!-- tampilkan foto default -->
                                    <img style="max-height:375px" src="<?= base_url($data['foto']) ?>" class="img-fluid" alt="<?= $data['id_barang'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('logout') ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="/jquery/jquery.js"></script>
    <script src="/bootstrap/js/bootstrap.bundle.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/jquery-easing/jquery.easing.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/js/sb-admin-2.js"></script>

    <!-- Page level plugins -->
    <script src="/chart.js/Chart.js"></script>

    <!-- Page level custom scripts -->
    <script src="/js/demo/chart-area-demo.js"></script>
    <script src="/js/demo/chart-pie-demo.js"></script>

</body>

</html>
