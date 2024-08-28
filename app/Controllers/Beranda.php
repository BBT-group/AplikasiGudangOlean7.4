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
        $data = [
            'jumlah_barang' => $this->barangModel->getBarangCount(),
            'barang_masuk' => $this->barangMasuk->getBarangMasukCount(),
            'barang_keluar' => $this->barangKeluar->getBarangKeluarCount(),
            'jumlah_alat' => $this->inventarisModel->getAlatCount(),
            'jumlah_satuan' => $satuan->countAll(),
            'jumlah_kategori' => $kategori->countAll(),
            'chart_data' => $this->peminjaman->getChartData(),
            'msbarang_masuk' => $this->msbarangMasuk->getBarangMasukPerBulan(),
            'msbarang_keluar' => $this->msbarangKeluar->getBarangKeluarPerBulan(),
        ];
        echo view('v_header');
        return view('v_dashboard', $data);
    }
}
