<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/img/logo.png">
    <title>Laporan Stok Barang - Print</title>
    <link rel="stylesheet" href="<?= base_url('/css/print.css') ?>"> <!-- Add your custom print CSS here -->
</head>
<body>
    <div class="print-container">
        <h1 class="text-center">LAPORAN STOK BARANG GUDANG PT.OLEAN PERMATA</h1>
        
        <table border="1" cellspacing="0" cellpadding="5" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id Barang</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Satuan</th>
                    <th>Harga Beli</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($barang as $item) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $item['id_barang'] ?></td>
                        <td><?= $item['nama'] ?></td>
                        <td><?= $item['nama_kategori'] ?></td>
                        <td><?= $item['stok'] ?></td>
                        <td><?= $item['nama_satuan'] ?></td>
                        <td><?= $item['harga_beli'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        window.print(); // Automatically trigger the print dialog
    </script>
</body>
</html>
