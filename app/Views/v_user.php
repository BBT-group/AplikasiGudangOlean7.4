                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!-- <h1 class="h3 mb-2 text-gray-800">Management User</h1> -->
                    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
                        </div>
                        <div class="card-body pt-2">
                            <div class="table-responsive">
                                <div class="flex-box pb-1">
                                    <div class="col-12 mb-1 p-0">
                                        <a href="<?= base_url('user/create') ?>" method="post" class="btn btn-primary">Tambah Akun</a>
                                    </div>
                                </div>
                                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Username</th>
                                            <th>Nama</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($users as $user) : ?>
                                            <tr>
                                                <td><?= $user['id_ms_user'] ?></td>
                                                <td><?= $user['username'] ?></td>
                                                <td><?= $user['nama'] ?></td>
                                                <td><?= $user['role'] ?></td>
                                                <td><?= $user['status'] ?></td>
                                                <td style="text-align: center;">
                                                    <a href="/user/edit/<?= $user['id_ms_user'] ?>" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                                    <?php if ($user['role'] != 'admin') : ?>
                                                        <a href="/user/delete/<?= $user['id_ms_user'] ?>" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash"></i></a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
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
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                <!-- Page level custom scripts -->
                <script src="/js/demo/datatables-demo.js"></script>

                <script>
                    $(function() {
                        $('[data-toggle="tooltip"]').tooltip()
                    })
                </script>
                <script>
                    document.querySelectorAll('.btn-danger').forEach(function(button) {
                        button.addEventListener('click', function(event) {
                            event.preventDefault();
                            const url = this.getAttribute('href');

                            Swal.fire({
                                title: "Apakah Anda yakin ingin menghapus akun ini?",
                                showCancelButton: true,
                                confirmButtonText: "Hapus",
                                cancelButtonText: "Batal"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                        window.location.href = url;
                                }
                            });
                        });
                    });
                </script>

                </body>

                </html>