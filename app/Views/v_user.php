<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
        </div>
        <div class="card-body pt-2">
            <div class="table-responsive">
                <div class="flex-box pb-1">
                    <div class="col-12 mb-1 p-0">
                        <a href="<?= base_url('user/create') ?>" method="post" class="btn btn-primary btn-sm">Tambah Akun</a>
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
                            <th>Password</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <td class="p-1 pl-3"><?= $user['id_ms_user'] ?></td>
                                <td class="p-1 pl-3"><?= $user['username'] ?></td>
                                <td class="p-1 pl-3"><?= $user['nama'] ?></td>
                                <td class="p-1 pl-3"><?= $user['role'] ?></td>
                                <td class="p-1 pl-3"><?= ($user['status'] == '1') ? 'online' : 'offline' ?></td>
                                <td class="p-1 pl-3">
                                    <div style="display: flex; align-items: center; justify-content: space-between;">
                                        <span class="password-text" style="display: none;"><?= $user['password']; ?></span>
                                        <span class="password-hidden">******</span>
                                        <i class="fa fa-eye-slash toggle-password" style="cursor: pointer;"></i>
                                    </div>
                                </td>
                                <td class="p-1 pl-3" style="text-align: center;">
                                    <a href="<?= base_url('/user/edit/') . $user['id_ms_user'] ?>" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                    <?php if ($user['role'] != 'admin') : ?>
                                        <a href="<?= base_url('/user/delete/') . $user['id_ms_user'] ?>" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash"></i></a>
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

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Team IT PT. Olean</span>
        </div>
    </div>
</footer>

</div>
</div>
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- JavaScript -->
<script src="/jquery/jquery.js"></script>
<script src="/bootstrap/js/bootstrap.bundle.js"></script>
<script src="/jquery-easing/jquery.easing.js"></script>
<script src="/js/sb-admin-2.js"></script>
<script src="/datatables/jquery.dataTables.js"></script>
<script src="/datatables/dataTables.bootstrap4.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/js/demo/datatables-demo.js"></script>

<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });

    document.querySelectorAll('.toggle-password').forEach(function(toggleIcon) {
        toggleIcon.addEventListener('click', function() {
            const passwordText = this.previousElementSibling.previousElementSibling;
            const passwordHidden = this.previousElementSibling;

            // Toggle visibility
            if (passwordText.style.display === 'none') {
                passwordText.style.display = 'inline';
                passwordHidden.style.display = 'none';
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            } else {
                passwordText.style.display = 'none';
                passwordHidden.style.display = 'inline';
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            }
        });
    });

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