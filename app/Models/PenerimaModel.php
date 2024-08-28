<?php

namespace App\Models;

use CodeIgniter\Model;

class PenerimaModel extends Model
{
    protected $table = 'penerima';
    protected $primaryKey = 'id_penerima';

    protected $allowedFields = ['nama'];
}
