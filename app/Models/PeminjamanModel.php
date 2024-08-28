<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';
    protected $allowedFields = ['id_ms_peminjaman', 'id_inventaris', 'jumlah', 'stok_awal'];

    public function getByMasterId($id)
    {
        return $this->select('peminjaman.*,inventaris.*')
            ->join('inventaris', 'inventaris.id_inventaris = peminjaman.id_inventaris')
            ->where('id_ms_peminjaman', $id)->findAll();
    }
}
