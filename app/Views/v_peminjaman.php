<div class="container-fluid">



    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-2 text-gray-800">Inventory Management</h1> -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <h6 class="m-0 font-weight-bold text-primary">Data Pinjam Barang</h6>
        </div>
        <div class="card-body pt-2">
            <div class="table-responsive">
                <form id="addItemForm" action=<?= base_url('/barang_pinjam/update') ?> method="post" enctype="multipart/form-data">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-1">
                                    <label for="input1">tanggal dan waktu</label>
                                    <input type="text" class="form-control" id="datetime" name="datetime" value="<?php
                                                                                                                    date_default_timezone_set('Asia/Jakarta');
                                                                                                                    $currentDateTime = date("l, F j, Y H:i:s");
                                                                                                                    echo $currentDateTime;
                                                                                                                    ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group position-relative">
                                    <label for="penerima-input">Penerima</label>
                                    <input type="text" id="penerima" name="penerima" required class="form-control dropdown-input update-field"
                                        data-target="penerima-results" data-field="nama"
                                        placeholder="Search penerima..." autocomplete="off" value="<?= (old('penerima')) ? old('penerima') : session()->get('penerima_pinjam');   ?>">
                                    <div id="penerima-results" class="dropdown-menu"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="input2">Keterangan</label>
                                    <input type="text" class="form-control update-field <?php if (isset($validate)) {
                                                                                            echo $validate->hasError('keterangan') ? 'is-invalid' : '';
                                                                                        }  ?>" id="keterangan" name="keterangan" value="<?= (old('keterangan')) ? old('keterangan') : session()->get('keterangan_pinjam'); ?>">
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

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTabless" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id inventaris</th>
                                <th>Nama</th>
                                <th>stok</th>
                                <th>jumlah</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody id="inventoryTable">

                            <?php
                            foreach ($pinjam ?? [] as $index => $s) : ?>
                                <tr>
                                    <td class="p-1 pl-3"><?= $s['id_inventaris'] ?></td>
                                    <td class="p-1 pl-3"><?= $s['nama_inventaris'] ?></td>
                                    <td class="p-1 pl-3"><?= $s['stok_awal'] ?></td>
                                    <td class="p-1 pl-3"><input type="number" class="update-field" data-index="<?= $index ?>" data-column="stok" value="<?= esc($s['stok']) ?>"></td>
                                    <td class="p-1 pl-3"> <button class="remove-item btn btn-danger btn-sm" data-index="<?= $index ?>" data-key="<?= $s['id_inventaris'] ?>">Remove Item</button></td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
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
                            <th>Nama Barang</th>
                            <th>Stok</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php


                        if (!empty($inventaris)) : ?>
                            <?php foreach ($inventaris as $item) : ?>
                                <tr>

                                    <td class="p-1 pl-3"><?= $item['id_inventaris'] ?></td>
                                    <td class="p-1 pl-3"><?= $item['nama_inventaris'] ?></td>
                                    <td class="p-1 pl-3"><?= $item['stok'] ?></td>
                                    <td class="p-1 pl-3">
                                        <form action=<?= base_url('barang_pinjam/savedata') ?> method="post">
                                            <input type="text" name="id_inventaris" id="id_inventaris" value="<?= $item['id_inventaris'] ?>" hidden>
                                            <input type="text" name="nama_inventaris" id="nama_inventaris" value="<?= $item['nama_inventaris'] ?>" hidden>
                                            <input type="text" name="stok" id="stok" value="<?= $item['stok'] ?>" hidden>
                                            <button type="submit" class="btn btn-primary btn-sm" style="display: flexbox;">Submit</button>
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
    // Example data for satuan and kategori
    const penerimaData = <?= json_encode($penerima) ?>;

    $(document).click(function(e) {
        $(".dropdown-menu").hide();
    });
    $(document).ready(function() {
        $('.dropdown-input').on('keyup', function() {
            const input = $(this); // Current input field
            const target = $('#' + input.data('target')); // Corresponding dropdown
            const field = input.data('field'); // Field to filter on (e.g., nama_satuan, nama_kategori)
            const query = input.val().toLowerCase();
            const data = penerimaData; // Select dataset

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
                url: '<?= base_url('barang_pinjam/clearsession') ?>', // Adjust the URL as needed
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
            var penerima = $('#penerima').val();
            var ket = $('#keterangan').val();

            $.ajax({
                url: '<?= base_url('barang_pinjam/update2') ?>',
                method: 'POST',
                data: {
                    index: index,
                    column: column,
                    value: value,
                    penerima: penerima,
                    ket: ket,
                },
                success: function(response) {

                    if (response.status === 'success') {
                        console.log('Data updated successfully');
                    } else {
                        console.log('Data updated not');
                    }
                }
            });
        });

        // Function to capture barcode scan
        let first = true;
        let barcode = ''; // Initialize an empty string to store the scanned barcode
        let timeoutId = null; // Initialize a variable to store the timeout ID
        let lastKeyTime = Date.now();
        $(document).keypress(function(e) {
            let char = String.fromCharCode(e.which); // Convert the keypress event to the corresponding character
            let currentTime = Date.now();
            // Clear any existing timeout
            if (first) {

            }
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
                url: '<?= base_url('/barang_pinjam/hapusitem') ?>',
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
            url: '<?= base_url('barang_pinjam/carii') ?>',
            method: 'POST',
            data: {
                idBarang: id,
            },
            success: function(response) {
                if (response.status === 'success') {
                    console.log('Barcode scanned successfully');
                    location.reload(); // Reload the page to see updated data
                } else if (response.status === 'not_found') {
                    if (alert(response.message + "\n\nhubungi admin barang belum terdaftar")) {

                    }
                } else if (response.status === 'eror') {
                    console.log('Error: ' + response.message);
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