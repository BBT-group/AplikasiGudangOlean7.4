<?php

namespace App\Controllers;

use App\Models\BarangKeluarModel;
use App\Models\BarangMasukModel;
use App\Models\BarangModel;
use App\Models\InventarisModel;
use App\Models\KategoriModel;
use App\Models\MasterBarangMasukModel;
use App\Models\MasterBarangKeluarModel;
use App\Models\MasterPeminjamanModel;
use App\Models\SatuanModel;

class Beranda extends BaseController
{
    protected $barangModel;
    protected $inventarisModel;
    protected $barangMasuk;
    protected $barangKeluar;
    protected $peminjaman;
    protected $msbarangMasuk;
    protected $msbarangKeluar;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->inventarisModel = new inventarisModel();
        $this->barangMasuk = new BarangMasukModel();
        $this->barangKeluar = new BarangKeluarModel();
        $this->peminjaman = new MasterPeminjamanModel();
        $this->msbarangMasuk = new MasterBarangMasukModel();
        $this->msbarangKeluar = new MasterBarangKeluarModel();
    }
    public function index(): string
    {
        $satuan = new SatuanModel();
        $kategori = new KategoriModel();

        // Tahun saat ini dan tahun yang dipilih
        $currentYear = date('Y');
        $selectedYear = $this->request->getGet('year') ?? $currentYear;

        // Data barang masuk/keluar per bulan
        $barangMasuk = $this->msbarangMasuk->getBarangMasukPerBulan($selectedYear);
        $barangKeluar = $this->msbarangKeluar->getBarangKeluarPerBulan($selectedYear);

        // Format data agar sesuai dengan bulan (1-12)
        $formattedMasuk = array_fill(1, 12, 0);
        $formattedKeluar = array_fill(1, 12, 0);

        foreach ($barangMasuk as $bm) {
            $formattedMasuk[$bm['month']] = (int)$bm['total'];
        }

        foreach ($barangKeluar as $bk) {
            $formattedKeluar[$bk['month']] = (int)$bk['total'];
        }

        $data = [
            'jumlah_barang' => $this->barangModel->getBarangCount(),
            'barang_masuk' => $this->barangMasuk->getBarangMasukCount(),
            'barang_keluar' => $this->barangKeluar->getBarangKeluarCount(),
            'jumlah_alat' => $this->inventarisModel->getAlatCount(),
            'jumlah_satuan' => $satuan->countAll(),
            'jumlah_kategori' => $kategori->countAll(),
            'chart_data' => $this->peminjaman->getChartData(),
            'msbarang_masuk' => array_values($formattedMasuk), // Masukkan ke array sesuai format
            'msbarang_keluar' => array_values($formattedKeluar), // Masukkan ke array sesuai format
            'years' => range($currentYear - 10, $currentYear), // Dropdown untuk 10 tahun terakhir
            'selectedYear' => $selectedYear
        ];

        echo view('v_header');
        return view('v_dashboard', $data);
    }
}
