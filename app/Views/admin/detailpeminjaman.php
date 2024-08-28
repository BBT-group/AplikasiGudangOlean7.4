                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-2">
                            <h6 class="m-0 font-weight-bold text-primary">Detail Barang Pinjam</h6>
                        </div>

                        <div class="card-body pt-2">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label for="input1">Tanggal dan Waktu Peminjaman</label>
                                            <input type="text" class="form-control" value="<?= $header['tanggal_pinjam'] ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label for="input2">Penerima</label>
                                            <input type="text" class="form-control" value="<?= $header['nama'] ?>" readonly>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label for="input1">Tanggal dan Waktu Pengembalian</label>
                                            <input type="text" class="form-control" value="<?= $header['tanggal_kembali'] ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-1">
                                            <label for="input2">Status</label>
                                            <input type="text" class="form-control" value="<?php if ($header['status'] == 1) {

                                                                                                echo "Sedang dipinjam";
                                                                                            } else {
                                                                                                echo "Sudah dikembalikan";
                                                                                            } ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="input2">Keterangan</label>
                                            <input type="text" class="form-control" value="<?= $header['keterangan'] ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="container">                                
                                <div class="row">
                                    <div class="col mb-1 p-0" style="text-align: left;">
                                        <a href="<?= base_url('barang_pinjam') ?>" class="btn btn-primary btn-sm">kembali</a>
                                    </div>
                                    <div class="col mb-1 p-0" style="text-align: right;">
                                        <?php if ($header['status'] == 1) : ?>
                                            <form action="<?= base_url('barang_pinjam/updatestatus') ?>" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="id_ms_peminjaman" value="<?= $header['id_ms_peminjaman'] ?>" hidden>
                                                <button type="submit" class="btn btn-primary btn-sm">update status</button>
                                            </form>
                                        <?php endif; ?>

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
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><?php $no = 0;
                                            foreach ($barang as $item) : ?>
                                                <td class="p-1 pl-3"><?= $no += 1 ?></td>
                                                <td class="p-1 pl-3"><?= $item['id_inventaris'] ?></td>
                                                <td class="p-1 pl-3"><?= $item['nama_inventaris'] ?></td>
                                                <td class="p-1 pl-3"><?= $item['jumlah'] ?></td>
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