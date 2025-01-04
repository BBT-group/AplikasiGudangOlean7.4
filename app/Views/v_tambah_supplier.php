<!-- Begin Page Content -->
<div class="container-fluid">
    <?php
    if (isset($validation)) {
        echo $validation;
    }

    ?>
    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                    <?= isset($supplier) ? 'Edit Supplier' : 'Tambah Supplier' ?>
                </div>

                <div class="card-body">
                    <form id="addEditItemForm" action="<?= isset($supplier) ? base_url('supplier/updatesupplier/' . $supplier['id_supplier']) : base_url('supplier/tambahsupplier') ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="nama">Nama supplier</label>
                                    <input type="text" class="form-control" id="nama" name="nama" autofocus value="<?= isset($supplier) ? $supplier['nama'] : (old('nama') ?? '') ?>" required>
                                </div>
                            </div>
                        </div>
                        <a class="btn btn-secondary" href="<?= base_url('/supplier') ?>">Batal</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
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