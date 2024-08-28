<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangMasukModel extends Model
{
    protected $table = 'barang_masuk';
    protected $tableBarang = 'barang';
    protected $tableMsBarangMasuk = 'ms_barang_masuk';
    protected $tableSatuan = 'satuan';
    protected $primaryKey = 'id_barang_masuk';
    protected $allowedFields = ['id_barang', 'id_ms_barang_masuk', 'jumlah', 'id_inventaris', 'stok_awal'];

    public function getBarangMasuk()
    {
        return $this->findAll();
    }


    public function getBarangMasukGabung()
    {
        return $this->db->table($this->table)
            ->join($this->tableBarang, 'barang.id_barang = barang_masuk.id_barang')
            ->join($this->tableMsBarangMasuk, 'ms_barang_masuk.id_ms_barang_masuk = barang_masuk.id_ms_barang_masuk')
            ->get()
            ->getResultArray();
    }

    public function getBarangMasukGabungFilter($startDate, $endDate)
    {
        return $this->db->table($this->table)
            ->join($this->tableBarang, 'barang.id_barang = barang_masuk.id_barang')
            ->join($this->tableMsBarangMasuk, 'ms_barang_masuk.id_ms_barang_masuk = barang_masuk.id_ms_barang_masuk')
            ->where('DATE(waktu) >=', $startDate)
            ->where('DATE(waktu) <=', $endDate)
            ->get()
            ->getResultArray();
    }


    public function getByMasterId($id)
    {
        return $this->select('barang_masuk.*,barang.*,satuan.nama_satuan')
            ->join('barang', 'barang.id_barang=barang_masuk.id_barang')
            ->join('satuan', 'satuan.id_satuan=barang.id_satuan')
            ->where('id_ms_barang_masuk', $id)->findAll();
    }
    public function getAlatByMasterId($id)
    {
        return $this->select('barang_masuk.*,inventaris.*')
            ->join('inventaris', 'inventaris.id_inventaris=barang_masuk.id_inventaris')
            ->where('id_ms_barang_masuk', $id)->findAll();
    }

    public function getBarangMasukCount()
    {
        return $this->countAll();
    }
}
