<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Barang Masuk - Print</title>
    <link rel="stylesheet" href="<?= base_url('/css/print.css') ?>"> <!-- Add your custom print CSS here -->
</head>
<body>
    <div class="print-container">
        <h1 class="text-center">LAPORAN STOK INVENTARIS ALAT GUDANG PT.OLEAN PERMATA</h1>
        <table border="1" cellspacing="0" cellpadding="5" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id Barang</th>
                    <th>Nama Barang</th>
                    <th>Stok</th>
                    <th>Harga Beli</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($inventaris as $item) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $item['id_inventaris'] ?></td>
                        <td><?= $item['nama_inventaris'] ?></td>
                        <td><?= $item['stok'] ?></td>
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