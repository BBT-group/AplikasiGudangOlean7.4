<?php

namespace App\Models;

use CodeIgniter\Model;

class InventarisModel extends Model
{
    protected $table = 'inventaris';
    protected $primaryKey = 'id_inventaris';
    protected $allowedFields = ['id_inventaris', 'nama_inventaris', 'stok', 'harga_beli', 'foto'];

    public function getByName($nama)
    {

        return $this->where('nama_inventaris', $nama);
    }
    public function getById($nama)
    {
        return $this->where('id_inventaris', $nama);
    }

    public function getAlatCount()
    {
        return $this->countAll();
    }
}
