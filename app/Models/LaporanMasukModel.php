<?php

namespace App\Models;

use CodeIgniter\Model;
use PhpOffice\PhpSpreadsheet\Writer\Ods\Thumbnails;

class LaporanMasukModel extends Model
{
    protected $table = 'barang_masuk';
    protected $tableBarang = 'barang';
    protected $tableInventaris = 'inventaris';
    protected $tableMsBarangMasuk = 'ms_barang_masuk';
    protected $tableSatuan = 'satuan';
    protected $primaryKey = 'id_barang_masuk';
    protected $allowedFields = ['id_barang', 'id_ms_barang_masuk', 'jumlah', 'id_inventaris'];

    public function getBarangMasuk()
    {
        return $this->findAll();
    }

    public function getBarangMasukGabung()
    {
        return $this->db->table($this->table)
            ->select('barang_masuk.*, barang.stok, barang.harga_beli, barang.nama, ms_barang_masuk.waktu, satuan.nama_satuan')
            ->join($this->tableBarang, 'barang.id_barang = barang_masuk.id_barang')
            ->join($this->tableMsBarangMasuk, 'ms_barang_masuk.id_ms_barang_masuk = barang_masuk.id_ms_barang_masuk')
            ->join($this->tableSatuan, 'satuan.id_satuan = barang.id_satuan')
            ->get()
            ->getResultArray();
    }

    public function getBarangMasukGabungFilter($start_date, $end_date)
    {
        return $this->db->table($this->table)
            ->select('barang_masuk.*, barang.stok, barang.harga_beli, barang.nama, ms_barang_masuk.waktu, satuan.nama_satuan')
            ->join($this->tableBarang, 'barang.id_barang = barang_masuk.id_barang')
            ->join($this->tableMsBarangMasuk, 'ms_barang_masuk.id_ms_barang_masuk = barang_masuk.id_ms_barang_masuk')
            ->join($this->tableSatuan, 'satuan.id_satuan = barang.id_satuan')
            ->where('DATE(ms_barang_masuk.waktu) >=', $start_date)
            ->where('DATE(ms_barang_masuk.waktu) <=', $end_date)
            ->get()
            ->getResultArray();
    }

    public function getByMasterId($id)
    {
        return $this->where('id_barang_masuk', $id)->findAll();
    }

    public function getAlatMasukGabung()
    {
        return $this->db->table($this->table)
            ->select('barang_masuk.*, inventaris.stok, inventaris.harga_beli, inventaris.nama_inventaris, ms_barang_masuk.waktu')
            ->join('inventaris', 'inventaris.id_inventaris = barang_masuk.id_inventaris')
            ->join($this->tableMsBarangMasuk, 'ms_barang_masuk.id_ms_barang_masuk = barang_masuk.id_ms_barang_masuk')
            ->get()
            ->getResultArray();
    }

    public function getAlatMasukGabungFilter($start_date, $end_date)
    {
        return $this->db->table($this->table)
            ->select('barang_masuk.*, inventaris.stok, inventaris.harga_beli, inventaris.nama_inventaris, ms_barang_masuk.waktu')
            ->join('inventaris', 'inventaris.id_inventaris = barang_masuk.id_inventaris')
            ->join($this->tableMsBarangMasuk, 'ms_barang_masuk.id_ms_barang_masuk = barang_masuk.id_ms_barang_masuk')
            ->where('DATE(ms_barang_masuk.waktu) >=', $start_date)
            ->where('DATE(ms_barang_masuk.waktu) <=', $end_date)
            ->get()
            ->getResultArray();
    }
}
