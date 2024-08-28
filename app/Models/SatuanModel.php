<?php

namespace App\Models;

use CodeIgniter\Model;

class SatuanModel extends Model
{
    protected $table = 'satuan';
    protected $primaryKey = 'id_satuan';
    protected $allowedFields = ['nama_satuan'];

    public function getSatuan()
    {
        return $this->findAll();
    }

    public function tambahSatuan($data)
    {
        return $this->insert($data);
    }

    public function deleteSatuan($id)
    {
        return $this->db->table('satuan')->where('id_satuan', $id)->delete();
    }
}
