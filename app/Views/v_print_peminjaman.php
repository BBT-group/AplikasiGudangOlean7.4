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
        <h1 class="text-center">LAPORAN PEMINJAMAN ALAT GUDANG PT.OLEAN PERMATA</h1>
        <p class="text-center">Periode: <?= ($start_date ? $start_date : 'Semua') ?> - <?= ($end_date ? $end_date : 'Semua') ?></p>
        <table border="1" cellspacing="0" cellpadding="5" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Peminjaman</th>
                    <th>Tanggal Pinjam</th>
                    <th>Nama Alat</th>
                    <th>Jumlah</th>
                    <th>Nama Penerima</th>
                    <th>Tanggal Kembali</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($peminjaman)) : ?>
                    <?php $no = 1; foreach ($peminjaman as $item) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $item['id_peminjaman'] ?></td>
                            <td><?= $item['tanggal_pinjam'] ? date('d/m/Y H:i:s', strtotime($item['tanggal_pinjam'])) : '-' ?></td>
                            <td><?= $item['nama_inventaris'] ?></td>
                            <td><?= $item['jumlah'] ?></td>
                            <td><?= $item['nama_penerima'] ?></td>
                            <td><?= $item['tanggal_kembali'] ? date('d/m/Y H:i:s', strtotime($item['tanggal_kembali'])) : '-' ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script>
        window.print(); // Automatically trigger the print dialog
    </script>
</body>
</html>
