                <div class="container-fluid">                
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-2">
                            <h6 class="m-0 font-weight-bold text-primary">Data Stok Alat</h6>
                        </div>
                        <div class="card-body pt-2">
                            <div class="table-responsive">

                                <div class="col-12 mb-1 p-0">
                                    <div class="flex-box pb-1">
                                        <?php if (session()->role == 'admin') : ?>
                                            <div class="col-12 mb-1 p-0">
                                                <a href="<?= base_url('inventaris/indextambah') ?>" method="post" class="btn btn-primary btn-sm">Tambah Alat</a>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                </div>
                                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Inventaris</th>
                                            <th>Nama</th>
                                            <th>Stok</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($alat as $k => $item) : ?>
                                            <tr>
                                                <td class="p-1 pl-3"><?= $k + 1 ?></td>
                                                <td class="p-1 pl-3"><?= $item['id_inventaris'] ?></td>
                                                <td class="p-1 pl-3"><?= $item['nama_inventaris'] ?></td>
                                                <td class="p-1 pl-3"><?= $item['stok'] ?></td>
                                                <td class="p-1 pl-3" style="display: flexbox; text-align: center;">
                                                    <a href="<?= base_url('inventaris/indexdetail/' . $item['id_inventaris']) ?>" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-clone"></i></a>
                                                    <?php if (session()->role == 'admin') : ?>
                                                        <a href="<?= base_url('inventaris/indexupdate/' . $item['id_inventaris']) ?>" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Update"><i class="fas fa-pencil-alt"></i></a>
                                                        <a href="<?= base_url('inventaris/deletealat/' . $item['id_inventaris']) ?>" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus" id="hapus"><i class="fas fa-trash"></i></a>
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

                <!-- Page level custom scripts -->
                <script src="/js/demo/datatables-demo.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                <script>
                    <?php if (session()->getFlashdata('success')) { ?>
                        Swal.fire({
                            icon: "success",
                            title: "<?= session()->getFlashdata('success') ?>",
                            showConfirmButton: false,
                            timer: 1500
                        })
                    <?php } ?>                    
                </script>
                <script>
                    document.querySelectorAll('.btn-danger').forEach(function(button) {
                        button.addEventListener('click', function(event) {
                            event.preventDefault();
                            const url = this.getAttribute('href');

                            Swal.fire({
                                title: "Menghapus data alat akan menghapus riwayat transaksi yang bersangkutan. Apakah anda yakin ingin menghapus?",
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
                <script>
                    $(function() {
                        $('[data-toggle="tooltip"]').tooltip()
                    })
                </script>

                </body>

                </html>