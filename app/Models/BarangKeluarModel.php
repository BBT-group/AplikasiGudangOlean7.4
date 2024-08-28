<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangKeluarModel extends Model
{
    protected $table = 'barang_keluar';
    protected $primaryKey = 'id_barang_keluar';
    protected $allowedFields = ['id_barang', 'id_ms_barang_keluar', 'jumlah', 'stok_awal'];

    public function getBarangKeluar()
    {
        return $this->findAll();
    }

    public function getByMasterId($id)
    {
        return $this->select('barang_keluar.*,barang.*,satuan.nama_satuan')
            ->join('barang', 'barang.id_barang=barang_keluar.id_barang')
            ->join('satuan', 'satuan.id_satuan=barang.id_satuan')
            ->where('id_ms_barang_keluar', $id)->findAll();
    }
    public function getBarangKeluarCount()
    {
        return $this->countAll();
    }
}
