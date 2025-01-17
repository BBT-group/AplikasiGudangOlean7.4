<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/img/logo.png">
    <title>Laporan Barang Keluar - Print</title>
    <link rel="stylesheet" href="<?= base_url('/css/print.css') ?>"> <!-- Add your custom print CSS here -->
</head>

<body>
    <div class="print-container">
        <h1 class="text-center">LAPORAN BARANG KELUAR GUDANG </h1>
        <h1 class="text-center">OLEAN GROUP</h1>
        <p class="text-center">Periode: <?= ($start_date ? $start_date : 'Semua') ?> - <?= ($end_date ? $end_date : 'Semua') ?></p>
        <table border="1" cellspacing="0" cellpadding="5" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Barang Keluar</th>
                    <th>Tanggal</th>
                    <th>Nama Barang</th>
                    <th>Satuan</th>
                    <th>Nama Penerima</th>
                    <th>Stok Awal</th>
                    <th>Jumlah Keluar</th>
                    <th>Stok Akhir</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($barangkeluar as $item) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $item['id_barang'] ?></td>
                        <td><?= date('d/m/Y H:i:s', strtotime($item['waktu'])) ?></td>
                        <td><?= $item['nama_barang'] ?></td>
                        <td><?= $item['nama_satuan'] ?></td>
                        <td><?= $item['nama_penerima'] ?></td>
                        <td><?= $item['stok_awal'] ?></td> <!-- Mengisi stok awal -->
                        <td><?= $item['jumlah'] ?></td>
                        <td><?= $item['stok_awal'] - $item['jumlah'] ?></td>
                        <td><?= $item['keterangan'] ?></td>
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