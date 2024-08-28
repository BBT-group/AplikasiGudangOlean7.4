<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'ms_user';
    protected $primaryKey = 'id_ms_user';
    protected $allowedFields = ['username', 'password', 'role', 'nama', 'status'];

    public function getUserById($id)
    {
        return $this->find($id);
    }

    public function updatePassword($id, $newPassword)
    {
        return $this->update($id, ['password' => $newPassword]);
    }

    public function verifyPassword($id, $password)
    {
        $user = $this->find($id);
        
        // Check if 'password' key exists in $user array
        if (!isset($user['password'])) {
            // Handle the error, perhaps log it or return a specific value
            return false;
        }

        return $password === $user['password'];
    }
}
