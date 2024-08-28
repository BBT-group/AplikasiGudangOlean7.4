                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!-- <h1 class="h3 mb-2 text-gray-800">Laporan peminjaman</h1> -->

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body p-2">
                            <form method="get" action="<?= base_url('/laporan_peminjaman') ?>">
                                <div class="form-group row mb-1">
                                    <label for="start_date" class="col-sm-2 col-form-label">Start Date</label>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control" id="start_date" name="start_date" value="<?= isset($start_date) ? $start_date : '' ?>">
                                    </div>
                                    <label for="end_date" class="col-sm-2 col-form-label">End Date</label>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control" id="end_date" name="end_date" value="<?= isset($end_date) ? $end_date : '' ?>">
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-6">
                                        <a href="<?= base_url('/laporan_peminjaman') ?>" class="btn btn-secondary btn-sm mr-2">Reset</a>
                                        <button type="submit" class="btn btn-primary btn-sm mr-2">Tampilkan</button>
                                    </div>
                                    <div class="col-md-6" style="text-align: end;">

                                        <?php if (session()->role == 'admin'): ?>
                                            <a href="<?= base_url('/laporan_peminjaman/exportp?start_date=' . (isset($start_date) ? $start_date : '') . '&end_date=' . (isset($end_date) ? $end_date : '')) ?>" class="btn btn-success btn-sm"><i class="fa fa-file-excel"></i> Export to Excel</a>
                                            <a href="<?= base_url('/laporan_peminjaman/printp?start_date=' . (isset($start_date) ? $start_date : '') . '&end_date=' . (isset($end_date) ? $end_date : '')) ?>" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-print"></i> Print</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-2">
                            <h6 class="m-0 font-weight-bold text-primary">Data Barang Pinjam dari <?= $start_date ?> s/d <?= $end_date ?></h6>
                        </div>
                        <div class="card-body pt-2">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="dataTables" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Peminjaman</th>
                                            <th>Tanggal Pinjam</th>
                                            <th>Nama Alat</th>
                                            <th>Jumlah</th>
                                            <th>Nama Penerima</th>
                                            <th>Tanggal Kembali</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($peminjaman)) : ?>
                                            <?php $no = 1;
                                            foreach ($peminjaman as $item) : ?>
                                                <tr>
                                                    <td class="p-1 pl-3"><?= $no++ ?></td>
                                                    <td class="p-1 pl-3"><?= $item['id_peminjaman'] ?></td>
                                                    <td class="p-1 pl-3"><?= $item['tanggal_pinjam'] ? date('d/m/Y H:i:s', strtotime($item['tanggal_pinjam'])) : '-' ?></td>
                                                    <td class="p-1 pl-3"><?= $item['nama_inventaris'] ?></td>
                                                    <td class="p-1 pl-3"><?= $item['jumlah'] ?></td>
                                                    <td class="p-1 pl-3"><?= $item['nama_penerima'] ?></td>
                                                    <td class="p-1 pl-3"><?= $item['tanggal_kembali'] ? date('d/m/Y H:i:s', strtotime($item['tanggal_kembali'])) : '-' ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Team IT PT. Olean</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

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

                <script>
                    $(function() {
                        $("#start_date").datepicker({
                            dateFormat: 'yy-mm-dd'
                        });
                        $("#end_date").datepicker({
                            dateFormat: 'yy-mm-dd'
                        });
                    });
                </script>

                </body>

                </html>