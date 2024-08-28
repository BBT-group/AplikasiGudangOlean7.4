<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // Tampilkan semua akun
    public function index()
    {
        $data['users'] = $this->userModel->findAll();
        echo view('v_header');
        return view('v_user', $data);
    }

    // Tampilkan form untuk membuat akun baru
    public function create()
    {
        return view('v_user_tambah');
    }

    // Simpan data akun baru
    public function store()
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'), // Simpan langsung
            'role' => $this->request->getPost('role'),
            'nama' => $this->request->getPost('nama'),
            'status' => $this->request->getPost('status')
        ];
    
        $this->userModel->save($data);
        return redirect()->to('/user');
    }

    // Tampilkan form untuk mengedit akun
    public function edit($id)
    {
        $data['user'] = $this->userModel->find($id);
        return view('v_user_edit', $data);
    }

    // Update data akun
    public function update($id)
    {
        $data = [
            'id_ms_user' => $id,
            'username' => $this->request->getPost('username'),
            'role' => $this->request->getPost('role'),
            'nama' => $this->request->getPost('nama'),
            'status' => $this->request->getPost('status')
        ];
    
        // Update password jika diisi
        if ($this->request->getPost('password')) {
            $data['password'] = $this->request->getPost('password'); // Simpan langsung
        }
    
        $this->userModel->save($data);
        return redirect()->to('/user');
    }

    // Hapus akun
    public function delete($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('/user');
    }

    // Update password admin
    public function updatePassword($id)
    {
        $newPassword = $this->request->getPost('new_password');
    
        if ($newPassword) {
            $data = [
                'id_ms_user' => $id,
                'password' => $newPassword // Simpan langsung
            ];
    
            $this->userModel->save($data);
        }
    
        return redirect()->to('/user');
    }
}
