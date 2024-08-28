                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <!-- <h1 class="h3 mb-2 text-gray-800">Pinjam Alat</h1> -->
                        <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

                        <div class="card mb-4">
                            <div class="card-body p-2">
                                <form method="get" action="<?= base_url('barang_pinjam/beranda') ?>">
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
                                    <div class="row">
                                        <div class="col-6 mb-1 ">

                                            <a href="<?= base_url('barang_pinjam/index') ?>" class="btn btn-primary btn-sm">Pinjam Alat</a>
                                        </div>

                                        <div class="col-6 mb-1 " style="text-align: right;">
                                            <a href="<?= base_url('barang_pinjam/beranda') ?>" class="btn btn-secondary btn-sm">Reset</a>
                                            <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>

                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-2">
                                <h6 class="m-0 font-weight-bold text-primary">Data peminjaman</h6>
                            </div>
                            <div class="card-body pt-2">

                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Id Peminjaman</th>
                                                <th>Tanggal Pinjam</th>
                                                <th>Teknisi</th>
                                                <th>Status</th>
                                                <th>Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php


                                            if (!empty($pinjam)) : ?>

                                                <?php
                                                $no = 0;
                                                foreach ($pinjam as $item) :
                                                ?>
                                                    <tr>
                                                        <td class="p-1 pl-3"><?= $no += 1 ?></td>
                                                        <td class="p-1 pl-3"><?= $item['id_ms_peminjaman'] ?></td>
                                                        <td class="p-1 pl-3"><?= date('d-m-Y H:i:s', strtotime($item['tanggal_pinjam'])) ?></td>
                                                        <td class="p-1 pl-3"><?= $item['nama'] ?></td>
                                                        <td class="p-1 pl-3"><?= ($item['status'] == 1) ? 'Dipinjam' : 'Dikembalikan' ?></td>
                                                        <td class="p-1 pl-3" style="text-align: center;"> <a href="<?= base_url('barang_pinjam/indexdetailmaster/' . $item['id_ms_peminjaman']) ?>" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-clone"></i></a></td>
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
                        window.onload = function() {
                            <?php if (session()->has('error')) : ?>
                                alert("<?= addslashes(session('error')) ?>");
                            <?php elseif (session()->has('message')) : ?>
                                alert("<?= addslashes(session('message')) ?>");
                            <?php endif; ?>
                        };
                    </script>

                    <script>
                        $(function() {
                            $('[data-toggle="tooltip"]').tooltip()
                        })
                    </script>
                    </body>

                    </html>