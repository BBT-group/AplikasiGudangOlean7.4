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
                                <div class="form-group mb-1">
                                    <label for="input2">Penerima</label>

                                    <input
                                        type="text"
                                        class="form-control  update-field <?= isset($validate) && $validate->hasError('nama_penerima') ? 'is-invalid' : '' ?>"
                                        id="nama_penerima"
                                        name="nama_penerima"
                                        value="<?= (old('nama_penerima')) ? old('nama_penerima') : session()->get('penerima_pinjam') ?>"
                                        list="penerima-options"
                                        placeholder="Pilih atau masukkan nama penerima"
                                        required>
                                    <datalist id="penerima-options">
                                        <?php foreach ($penerima as $p): ?>
                                            <option value="<?= $p['nama'] ?>"></option>
                                        <?php endforeach; ?>
                                    </datalist>

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
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-6 mb-1">
                                <a href="<?= base_url('barang_pinjam/cari') ?>" class="btn btn-primary btn-sm">Cari Barang</a>
                            </div>
                            <div class="col-6 mb-1" style="text-align: right;">
                                <button id="clear-session-btn" class="btn btn-secondary btn-sm">Clear Session</button>
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
            var penerima = $('#nama_penerima').val();
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