<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanInventarisModel extends Model
{
    protected $table = 'inventaris';
    protected $primaryKey = 'id_inventaris';


    public function getInventaris()
    {
        return $this->findAll();
    }

    public function getInventarisGabung()
    {
        return $this->db->table($this->table)
            ->select('inventaris.*')
            ->get()
            ->getResultArray();
    }
}
