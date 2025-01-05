                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-2">
                            <h6 class="m-0 font-weight-bold text-primary">Detail Barang Pinjam</h6>
                        </div>

                        <div class="card-body pt-2">
                            <div class="container p-0">
                                <div class="row">
                                    <div class="col-md-6 pl-0">
                                        <div class="form-group mb-1">
                                            <label for="input1">Tanggal dan Waktu Peminjaman</label>
                                            <input type="text" class="form-control form-control-sm" value="<?= date('d/m/Y H:i:s', strtotime($header['tanggal_pinjam'])) ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-0">
                                        <div class="form-group mb-1">
                                            <label for="input1">Tanggal dan Waktu Pengembalian</label>
                                            <input type="text" class="form-control form-control-sm" value="<?= ($header['tanggal_kembali'] != null) ? date('d/m/Y H:i:s', strtotime($header['tanggal_kembali'])) : '-' ?>" readonly>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6 pl-0">
                                        <div class="form-group mb-1">
                                            <label for="input2">Penerima</label>
                                            <input type="text" class="form-control form-control-sm" value="<?= $header['nama'] ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-0">
                                        <div class="form-group mb-1">
                                            <label for="input2">Status</label>
                                            <input type="text" class="form-control form-control-sm" value="<?php if ($header['status'] == 1) {

                                                                                                                echo "Sedang dipinjam";
                                                                                                            } else {
                                                                                                                echo "Sudah dikembalikan";
                                                                                                            } ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 p-0">
                                        <div class="form-group">
                                            <label for="input2">Keterangan</label>
                                            <input type="text" class="form-control form-control-sm" value="<?= $header['keterangan'] ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="container p-0">
                                <div class="row">
                                    <div class="col-md-6 pl-0" style="text-align: left;">
                                        <a href="<?= base_url('barang_pinjam') ?>" class="btn btn-secondary btn-sm">kembali</a>
                                    </div>
                                    <div class="col-md-6 pr-0" style="text-align: right;">
                                        <form action="<?= base_url('barang_pinjam/updatestatus') ?>" method="post" enctype="multipart/form-data">
                                            <?php if ($header['status'] == 1) : ?>
                                                <input type="hidden" name="id_ms_peminjaman" value="<?= $header['id_ms_peminjaman'] ?>" hidden>
                                                <button type="submit" class="btn btn-primary btn-sm">update status</button>
                                            <?php endif; ?>
                                            <a href="<?= base_url('/barang_pinjam/printd/' . $header['id_ms_peminjaman']) ?>" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-print"></i> Print</a>

                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="dataTabless" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Alat</th>
                                            <th>Nama Alat</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0;
                                        foreach ($barang as $item) : ?>
                                            <tr>
                                                <td class="p-1 pl-3"><?= $no += 1 ?></td>
                                                <td class="p-1 pl-3"><?= $item['id_inventaris'] ?></td>
                                                <td class="p-1 pl-3"><?= $item['nama_inventaris'] ?></td>
                                                <td class="p-1 pl-3"><?= $item['jumlah'] ?></td>


                                            </tr>
                                        <?php endforeach; ?>
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