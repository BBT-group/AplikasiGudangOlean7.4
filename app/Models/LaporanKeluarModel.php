<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanKeluarModel extends Model
{
    protected $table = 'barang_keluar';
    protected $tableBarang = 'barang';
    protected $tablePenerima = 'penerima';
    protected $tableMsBarangKeluar = 'ms_barang_keluar';
    protected $tableSatuan = 'satuan';
    protected $primaryKey = 'id_barang_keluar';
    protected $allowedFields = ['id_barang', 'id_ms_barang_keluar', 'jumlah'];

    public function getBarangKeluar()
    {
        return $this->findAll();
    }

    public function getBarangKeluarGabung()
    {
        return $this->db->table($this->table)
            ->select('barang_keluar.*, barang.nama as nama_barang,barang.stok, barang.harga_beli, penerima.nama as nama_penerima, ms_barang_keluar.waktu,satuan.nama_satuan')
            ->join($this->tableBarang, 'barang.id_barang = barang_keluar.id_barang')
            ->join($this->tableMsBarangKeluar, 'ms_barang_keluar.id_ms_barang_keluar = barang_keluar.id_ms_barang_keluar')
            ->join($this->tablePenerima, 'penerima.id_penerima = ms_barang_keluar.id_penerima')
            ->join($this->tableSatuan, 'satuan.id_satuan = barang.id_satuan')
            ->get()
            ->getResultArray();
    }

    public function getBarangKeluarGabungFilter($start_date, $end_date)
    {
        return $this->db->table($this->table)
            ->select('barang_keluar.*, barang.nama as nama_barang, barang.stok, barang.harga_beli, penerima.nama as nama_penerima, ms_barang_keluar.waktu,satuan.nama_satuan')
            ->join($this->tableBarang, 'barang.id_barang = barang_keluar.id_barang')
            ->join($this->tableMsBarangKeluar, 'ms_barang_keluar.id_ms_barang_keluar = barang_keluar.id_ms_barang_keluar')
            ->join($this->tablePenerima, 'penerima.id_penerima = ms_barang_keluar.id_penerima')
            ->join($this->tableSatuan, 'satuan.id_satuan = barang.id_satuan')
            ->where('DATE(ms_barang_keluar.waktu) >=', $start_date)
            ->where('DATE(ms_barang_keluar.waktu) <=', $end_date)
            ->get()
            ->getResultArray();
    }

    public function getByMasterId($id)
    {
        return $this->where('id_barang_keluar', $id)->findAll();
    }
}
?>
