                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    Update Data Barang
                                </div>

                                <div class="card-body">
                                    <form id="addItemForm" action="<?= base_url('stok/updatebarang') ?>" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="id_barang">ID Barang</label>
                                                    <input type="text" class="form-control" id="id_barang" name="id_barang" value="<?= $data['id_barang'] ?>" readonly>
                                                    <input type="text" class="form-control" id="stok" name="stok" value="<?= $data['stok'] ?>" hidden>
                                                    <input type="text" class="form-control" id="harga_beli" name="harga_beli" value="<?= $data['harga_beli'] ?>" hidden>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama">Nama</label>
                                                    <input type="text" class="form-control <?= (array_key_exists('nama', $validation)) ? 'is-invalid' : ''; ?>" id="nama" name="nama" required maxlength="45" value="<?= $data['nama'] ?>">
                                                    <?php if (array_key_exists('nama', $validation)): ?>
                                                        <div class="invalid-feedback">
                                                            <?= $validation['nama'] ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="form-group position-relative">
                                                    <label for="satuan-input">Satuan</label>
                                                    <input type="text" id="satuan-input" name="id_satuan" required class="form-control dropdown-input"
                                                        data-target="satuan-results" data-field="nama_satuan"
                                                        placeholder="Search Satuan..." autocomplete="off" value="<?= $data['nama_satuan']; ?>">
                                                    <div id="satuan-results" class="dropdown-menu"></div>
                                                </div>
                                                <div class="form-group position-relative mt-3">
                                                    <label for="kategori-input">Kategori</label>
                                                    <input type="text" id="kategori-input" name="id_kategori" required class="form-control dropdown-input"
                                                        data-target="kategori-results" data-field="nama_kategori"
                                                        placeholder="Search Kategori..." autocomplete="off" value="<?= $data['nama_kategori']; ?>">
                                                    <div id="kategori-results" class="dropdown-menu"></div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="foto">Foto (kosongkan jika foto sama)</label>
                                                    <input type="file" class="form-control" id="foto" name="foto" maxlength="255">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-secondary" onclick="window.history.back();">Batal</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
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

                <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
                <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
                <script>
                    // Example data for satuan and kategori
                    const satuanData = <?= json_encode($satuan) ?>;
                    const kategoriData = <?= json_encode($kategori) ?>;
                    $(document).click(function(e) {
                        $(".dropdown-menu").hide();
                    });
                    $(document).ready(function() {
                        $('.dropdown-input').on('keyup', function() {
                            const input = $(this); // Current input field
                            const target = $('#' + input.data('target')); // Corresponding dropdown
                            const field = input.data('field'); // Field to filter on (e.g., nama_satuan, nama_kategori)
                            const query = input.val().toLowerCase();
                            const data = input.attr('id') === 'satuan-input' ? satuanData : kategoriData; // Select dataset

                            target.empty();

                            if (query.length > 0) {
                                let results = data.filter(item =>
                                    item[field] && item[field].toLowerCase().includes(query)
                                );

                                if (results.length > 0) {
                                    results.forEach(item => {
                                        target.append(`<a href="#" class="dropdown-item">${item[field]}</a>`);
                                    });
                                    target.show();
                                } else {
                                    target.append('<span class="dropdown-item disabled">No results found</span>');
                                    target.show();
                                }
                            } else {
                                target.hide();
                            }
                        });

                        // Event delegation for dropdown items
                        $('.dropdown-menu').on('click', '.dropdown-item', function(e) {
                            e.preventDefault();
                            const selectedValue = $(this).text(); // Get the clicked item's text
                            const targetInput = $(this).closest('.form-group').find('.dropdown-input');
                            targetInput.val(selectedValue); // Set the input value
                            $(this).closest('.dropdown-menu').hide(); // Hide the dropdown
                        });
                    });
                </script>
                <script>
                    $(document).ready(function() {
                        $('#id_satuan').select2({
                            placeholder: "<?= $data['nama_satuan'] ?>",
                            allowClear: true
                        });
                    });
                    $(document).ready(function() {
                        $('#id_kategori').select2({
                            placeholder: "<?= $data['nama_kategori'] ?>",
                            allowClear: true
                        });
                    });
                </script>

                </body>

                </html>