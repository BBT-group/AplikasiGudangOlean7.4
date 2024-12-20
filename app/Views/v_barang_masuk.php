<div class="container-fluid">
    <?php //dd(session()->get('datalist')) 
    ?>
    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-2 text-gray-800">Inventory Management</h1> -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <h6 class="m-0 font-weight-bold text-primary">Data Barang Masuk</h6>
        </div>
        <div class="card-body pt-2">
            <div class="table-responsive">
                <form id="addItemForm" action=<?= base_url('/barang_masuk/update') ?> method="post" enctype="multipart/form-data">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-1">
                                    <label for="input1">Tanggal dan waktu</label>
                                    <input type="text" class="form-control" id="datetime" name="datetime" value="<?php
                                                                                                                    date_default_timezone_set('Asia/Jakarta');
                                                                                                                    $currentDateTime = date("l, F j, Y H:i:s");
                                                                                                                    echo $currentDateTime;
                                                                                                                    ?>" disabled>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group position-relative">
                                    <label for="supplier-input">Supplier</label>
                                    <input type="text" id="nama_supplier" name="nama_supplier" required class="form-control dropdown-input update-field"
                                        data-target="supplier-results" data-field="nama"
                                        placeholder="Search Supplier..." autocomplete="off" value="<?= (old('supplier')) ? old('supplier') : session()->get('supplier');   ?>">
                                    <div id="supplier-results" class="dropdown-menu"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" class="form-control update-field <?php if (isset($validate)) {
                                                                                            echo $validate->hasError('nama_penerima') ? 'is-invalid' : '';
                                                                                        } ?>" id="keterangan" name="keterangan" value="<?= (old('keterangan')) ? old('keterangan') : session()->get('keterangan_masuk'); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-6 mb-1">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Cari Barang</button>
                                (tambah barang dengan scan barcode atau klik cari barang)
                            </div>
                            <div class="col-6 mb-1" style="text-align: right;">
                                <button id="clear-session-btn" class="btn btn-secondary btn-sm">Bersihkan Data</button>
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
                <table class="table table-striped table-bordered" id="dataTabless" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Barang</th>
                            <th>Nama Barang</th>
                            <th>Satuan</th>
                            <th>jumlah</th>
                            <th>Harga Beli</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody id="inventoryTable">
                        <?php
                        foreach ($barang ?? [] as $index => $s) : ?>
                            <tr>
                                <td class="p-1 pl-3"><?= $s['id_barang'] ?></td>
                                <td class="p-1 pl-3"><?= $s['nama'] ?></td>
                                <td class="p-1 pl-3"><?= $s['satuan'] ?></td>
                                <td class="p-1 pl-3"><input type="number" class="update-field" data-index="<?= $index ?>" data-column="stok" value="<?= esc($s['stok']) ?>"></td>
                                <td class="p-1 pl-3"><input type="number" class="update-field" data-index="<?= $index ?>" data-column="harga_beli" value="<?= esc($s['harga_beli']) ?>"></td>
                                <td class="p-1 pl-3"> <button class="remove-item btn btn-sm btn-danger" data-index="<?= $index ?>" data-key="<?= $s['id_barang'] ?>">Remove Item</button></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cari Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Barang</th>
                            <th>Nama</th>
                            <th>Stok</th>
                            <th>Kategori</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($barangs)) : ?>
                            <?php foreach ($barangs as $item) : ?>
                                <tr>
                                    <td class="p-1 pl-3"><?= $item['id_barang'] ?></td>
                                    <td class="p-1 pl-3"><?= $item['nama'] ?></td>
                                    <td class="p-1 pl-3"><?= $item['stok'] ?></td>
                                    <td class="p-1 pl-3"><?= $item['nama_kategori'] ?></td>
                                    <td class="p-1 pl-3">
                                        <form action=<?= base_url('/barang_masuk/savedata') ?> method="post">
                                            <input type="text" name="id_barang" id="id_barang" value="<?= $item['id_barang'] ?>" hidden>
                                            <input type="text" name="nama" id="nama" value="<?= $item['nama'] ?>" hidden>
                                            <input type="text" name="stok" id="stok" value="<?= $item['stok'] ?>" hidden>
                                            <input type="text" name="jenis" id="jenis" value="barang" hidden>
                                            <input type="text" name="satuan" id="satuan" value="<?= $item['nama_satuan'] ?>" hidden>
                                            <input type="text" name="harga_beli" id="harga_beli" value="<?= $item['harga_beli'] ?>" hidden>
                                            <button type="submit" class="btn btn-primary btn-sm" style="display: flexbox; text-align: center;">Submit</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php
                        if (!empty($inventaris)) : ?>
                            <?php foreach ($inventaris as $item) : ?>
                                <tr>

                                    <td class="p-1 pl-3"><?= $item['id_inventaris'] ?></td>
                                    <td class="p-1 pl-3"><?= $item['nama_inventaris'] ?></td>
                                    <td class="p-1 pl-3"><?= $item['stok'] ?></td>
                                    <td class="p-1 pl-3">alat</td>
                                    <td class="p-1 pl-3">
                                        <form action=<?= base_url('/barang_masuk/savedata') ?> method="post">
                                            <input type="text" name="id_barang" id="id_barang" value="<?= $item['id_inventaris'] ?>" hidden>
                                            <input type="text" name="nama" id="nama" value="<?= $item['nama_inventaris'] ?>" hidden>
                                            <input type="text" name="stok" id="stok" value="<?= $item['stok'] ?>" hidden>
                                            <input type="text" name="jenis" id="jenis" value="alat" hidden>
                                            <input type="text" name="satuan" id="satuan" value="alat" hidden>
                                            <input type="text" name="harga_beli" id="harga_beli" value="<?= $item['harga_beli'] ?>" hidden>
                                            <button type="submit" class="btn btn-primary btn-sm" style="display: flexbox; text-align: center;">Submit</button>
                                        </form>
                                    </td>
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


<div id="dialog-confirm" title="Barang / Alat Belum ditambahkan" style="display:none;">
    <p>Tambahkan Barang atau Alat Baru</p>
</div>

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
    // Example data for satuan and kategori
    const supplierData = <?= json_encode($supplier) ?>;

    $(document).click(function(e) {
        $(".dropdown-menu").hide();
    });
    $(document).ready(function() {
        $('.dropdown-input').on('keyup', function() {
            const input = $(this); // Current input field
            const target = $('#' + input.data('target')); // Corresponding dropdown
            const field = input.data('field'); // Field to filter on (e.g., nama_satuan, nama_kategori)
            const query = input.val().toLowerCase();
            const data = supplierData; // Select dataset

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
<!-- Page level custom scripts -->
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
    $(document).ready(function() {
        $('#clear-session-btn').click(function() {
            $.ajax({
                url: '<?= base_url('barang_masuk/clearsession') ?>', // Adjust the URL as needed
                method: 'POST',
                success: function(response) {
                    // $('.print').text('Response from server: ' + response);
                    // console.log(response);

                    alert('Session cleared successfully');
                },
                error: function(xhr, status, error) {
                    alert('Error clearing session: ' + error);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {

        $('.update-field').on('input', function() {
            var index = $(this).data('index');
            var column = $(this).data('column');
            var value = $(this).val();
            var supp = $("#nama_supplier").val();
            var ket = $("#keterangan").val();
            $.ajax({
                url: '<?= base_url('barang_masuk/update2') ?>',
                method: 'POST',
                data: {
                    index: index,
                    column: column,
                    value: value,
                    ket: ket,
                    supp: supp

                },
                success: function(response) {

                    if (response.status == 'success') {
                        console.log('Data updated successfully');
                    } else {
                        console.log('Data updated not');
                    }
                }
            });
        });
        let first = true;
        // Function to capture barcode scan
        let barcode = ''; // Initialize an empty string to store the scanned barcode
        let timeoutId = null; // Initialize a variable to store the timeout ID
        let lastKeyTime = Date.now();
        $(document).keypress(function(e) {
            let char = String.fromCharCode(e.which); // Convert the keypress event to the corresponding character
            let currentTime = Date.now();
            // Clear any existing timeout
            if (timeoutId) {
                clearTimeout(timeoutId);
            }


            barcode += char;
            if (currentTime - lastKeyTime < 10) {

                timeoutId = setTimeout(function() {

                    let id = barcode; // Assign the barcode string to the ID variable
                    console.log(barcode);
                    id = id.slice(0, -1);
                    handleBarcodeScan(id);
                    // Call a function to handle the barcode scan}


                    barcode = ''; // Reset the barcode string after handling the scan
                    timeoutId = null; // Reset the timeout ID
                    first = true;
                }, 200); // Reset the barcode string if more than 100ms passed since the last keypress
            } else {
                barcode = '';
            }
            if (first) {
                barcode += char;
                first = false;
            }
            lastKeyTime = currentTime;


            // Append character to barcode string
            // Append the current character to the barcode string

            // Set a timeout to handle the complete barcode after 200ms of no input

        });

        $('.remove-item').on('click', function() {
            var key = $(this).data('key');
            var index = $(this).data('index');
            console.log(key);
            $.ajax({
                url: '<?= base_url('/barang_masuk/hapusitem') ?>',
                type: 'POST',
                data: {
                    key: key,
                    index: index
                },
                success: function(response) {
                    if (response.status) {
                        $('button[data-index="' + index + '"]').closest('tr').remove();
                    }
                }
            });
        });
    });

    function handleBarcodeScan(id) {
        $.ajax({
            url: '<?= base_url('barang_masuk/carii') ?>',
            method: 'POST',
            data: {
                idBarang: id,
            },
            success: function(response) {
                if (response.status === 'success') {
                    console.log('Barcode scanned successfully');
                    location.reload(); // Reload the page to see updated data
                } else if (response.status === 'not_found') {
                    console.log(response.a);
                    console.log(response.b);
                    console.log(response.c);
                    console.log(response.d);
                    $("#dialog-confirm").dialog({
                        resizable: false,
                        height: "auto",
                        width: 400,
                        modal: true,
                        buttons: {
                            "Tambah Barang": function() {
                                window.location.href = '<?= base_url('/stok/indextambah') ?>';
                                $(this).dialog("close");
                            },
                            "Tambah Alat": function() {
                                window.location.href = '<?= base_url('/inventaris/indextambah') ?>';
                                $(this).dialog("close");
                            }
                        }
                    });
                }
            },
            error: function(jqXHR, text, eror) {
                console.log(eror.text);
            }
        });

    }
</script>



</body>

</html>