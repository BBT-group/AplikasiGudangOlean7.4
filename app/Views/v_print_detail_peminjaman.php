<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/img/logo.png">
    <title>Detail Peminjaman Alat - Print</title>
    <link rel="stylesheet" href="<?= base_url('/css/print.css') ?>"> <!-- Add your custom print CSS here -->
</head>

<body>
    <div class="print-container">
        <h1 class="text-center">DETAIL PEMINJAMAN ALAT GUDANG PT.OLEAN PERMATA</h1>
        <table border="1" cellspacing="0" cellpadding="5" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Barang</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Nama Penerima</th>
                    <th>Status</th>
                    <th>keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0;
                foreach ($pinjam as $item) : ?>
                    <tr>
                        <td><?= $no += 1 ?></td>
                        <td><?= $item['id_inventaris'] ?></td>
                        <td><?= $item['nama_inventaris'] ?></td>
                        <td><?= $item['jumlah'] ?></td>
                        <td><?= date('d-m-Y H:i:s', strtotime($peminjaman['tanggal_pinjam'])) ?></td>
                        <td><?= date('d-m-Y H:i:s', strtotime($peminjaman['tanggal_kembali'])) ?></td>
                        <td><?= $peminjaman['nama'] ?></td>
                        <td><?= $peminjaman['status'] == 0 ? 'Dipinjam' : 'Kembali'; ?></td>
                        <td><?= $peminjaman['keterangan'] ?></td>
                    </tr>
                <?php endforeach; ?>
                <!--  -->
            </tbody>
        </table>
    </div>

    <script>
        window.print(); // Automatically trigger the print dialog
    </script>
</body>

</html>