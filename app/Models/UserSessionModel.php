<?php

namespace App\Models;

use CodeIgniter\Model;

class UserSessionModel extends Model
{
    protected $table = 'user_session';
    protected $primaryKey = 'id_user_session';

    protected $allowedFields = ['waktu', 'id_ms_user'];
}
