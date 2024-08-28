                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-2">
                            <h6 class="m-0 font-weight-bold text-primary">Detail Barang Keluar</h6>
                        </div>

                        <div class="card-body pt-2">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label for="input1">Tanggal dan Waktu Barang Keluar</label>
                                            <input type="text" class="form-control" value="<?= $header['waktu'] ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label for="input2">Penerima</label>
                                            <input type="text" class="form-control" value="<?= $header['nama'] ?>" readonly>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="input2">Keterangan</label>
                                            <input type="text" class="form-control" value="<?= $header['keterangan'] ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-1 p-0" style="text-align: left;">
                                        <a href="<?= base_url('barang_keluar') ?>" class="btn btn-primary btn-sm">kembali</a>
                                    </div>

                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="dataTabless" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Stok Masuk</th>
                                            <th>Satuan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><?php $no = 0;
                                            foreach ($barang as $item) : ?>
                                                <td class="p-1 pl-3"><?= $no += 1 ?></td>
                                                <td class="p-1 pl-3"><?= $item['id_barang'] ?></td>
                                                <td class="p-1 pl-3"><?= $item['nama'] ?></td>
                                                <td class="p-1 pl-3"><?= $item['jumlah'] ?></td>
                                                <td class="p-1 pl-3"><?= $item['nama_satuan'] ?></td>
                                            <?php endforeach; ?>

                                        </tr>
                                    </tbody>
                                </table>
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
                <script src="/datatables/jquery.dataTables.js"></script>
                <script src="/datatables/dataTables.bootstrap4.js"></script>

                <!-- Page level custom scripts -->
                <script src="/js/demo/datatables-demo.js"></script>

                </body>

                </html>