<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/img/logo.png">
    <title>Laporan Barang Masuk - Print</title>
    <link rel="stylesheet" href="<?= base_url('/css/print.css') ?>"> <!-- Add your custom print CSS here -->
</head>
<body>
    <div class="print-container">
        <h1 class="text-center">LAPORAN MASUK STOK BARANG GUDANG PT.OLEAN PERMATA</h1>
        <p class="text-center">Periode: <?= ($start_date ? $start_date : 'Semua') ?> - <?= ($end_date ? $end_date : 'Semua') ?></p>
        <table border="1" cellspacing="0" cellpadding="5" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Barang</th>
                    <th>Tanggal</th>
                    <th>Nama Barang</th>
                    <th>Satuan</th>
                    <th>Harga Masuk</th>
                    <th>Stok Awal</th>
                    <th>Stok Masuk</th>
                    <th>Stok Akhir</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($barangmasuk as $item) : ?>
                    <?php $stok_awal = $item['stok'] - $item['jumlah']; ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $item['id_barang'] ?></td>
                        <td><?= date('d/m/Y H:i:s', strtotime($item['waktu'])) ?></td>
                        <td><?= $item['nama'] ?></td>
                        <td><?= $item['nama_satuan'] ?></td>
                        <td><?= $item['harga_beli'] ?></td>
                        <td><?= $stok_awal ?></td>
                        <td><?= $item['jumlah'] ?></td>
                        <td><?= $item['stok'] ?></td>
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
