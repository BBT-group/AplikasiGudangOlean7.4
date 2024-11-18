<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLogin extends Model
{
    protected $table = "ms_user";
    protected $primaryKey = "id_ms_user";
    protected $allowedFields = ['username', 'password', 'role', 'nama', 'status', 'last_login'];

    public function getData($parameter)
    {
        $builder = $this->table($this->table);
        $builder->where('username', $parameter);
        $query = $builder->get();
        return $query->getRowArray();
    }
}
