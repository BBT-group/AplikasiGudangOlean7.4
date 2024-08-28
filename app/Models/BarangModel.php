<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{

    protected $table = 'barang';
    protected $primaryKey = 'id_barang';

    protected $allowedFields = ['id_barang', 'nama', 'foto', 'merk', 'stok', 'harga_beli', 'id_kategori', 'id_satuan'];

    public function getBarang()
    {
        return $this->findAll();
    }

    public function getBarangWithKategori()
    {
        return $this->select('barang.*, kategori.nama_kategori,satuan.nama_satuan')
            ->join('kategori', 'kategori.id_kategori = barang.id_kategori')
            ->join('satuan', 'satuan.id_satuan = barang.id_satuan');
    }

    public function getBarangById($id_barang)
    {
        return $this->select('barang.*, kategori.nama_kategori,satuan.nama_satuan')
            ->join('kategori', 'kategori.id_kategori = barang.id_kategori')
            ->join('satuan', 'satuan.id_satuan = barang.id_satuan')
            ->where('id_barang', $id_barang)->first();
    }

    public function getBarangByName($name)
    {
        return $this->select('barang.*, kategori.nama_kategori')
            ->join('kategori', 'kategori.id_kategori = barang.id_kategori')
            ->join('satuan', 'satuan.id_satuan = barang.id_satuan')
            ->groupStart()
            ->like('barang.nama', $name)
            ->orLike('kategori.nama_kategori', $name)
            ->orLike('satuan.nama_satuan', $name)
            ->orLike('barang.id_barang', $name)
            ->groupEnd();
    }

    public function insertBarang($data)
    {
        $this->insert($data);
    }
    public function updateBarang($id, $data)
    {
        $this->update($id, $data);
    }

    public function getBarangWithSatuan($id)
    {
        return $this->select('barang.*, satuan.nama_satuan')
            ->join('satuan', 'satuan.id_satuan = barang.id_satuan')
            ->where('id_barang', $id);
    }

    public function getBarangWithInventaris() {}

    public function getBarangCount()
    {
        return $this->countAll();
    }
}
