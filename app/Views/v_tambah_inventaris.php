                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    Tambah Alat
                                </div>

                                <div class="card-body">
                                    <form id="addItemForm" action="<?= base_url('inventaris/simpanalat') ?>" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="id_inventaris">ID Alat</label>
                                                    <input type="text" class="form-control" id="id_inventaris" name="id_inventaris" autofocus value="<?php if (old('id_inventaris') != null) {
                                                                                                                                                            echo old('id_inventaris');
                                                                                                                                                        } elseif (session()->get('id_temp') != null) {
                                                                                                                                                            echo session()->get('id_temp');
                                                                                                                                                        } else {
                                                                                                                                                            '';
                                                                                                                                                        } ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama_inventaris">Nama</label>
                                                    <input type="text" class="form-control" id="nama_inventaris" name="nama_inventaris" required maxlength="45" value="<?= old('nama_inventaris') ?? '' ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="foto">Foto</label>
                                                    <input type="file" class="form-control" id="foto" name="foto" required maxlength="255">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-1"><a class="btn btn-danger btn-user btn-block" href="<?php echo base_url('beranda') ?>">Batal</a></div>
                                            <div class="col"><button type="submit" class="btn btn-primary">Submit</button></div>
                                        </div>

                                    </form>
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