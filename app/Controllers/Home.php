<?php

namespace App\Controllers;
use App\Models\ModelLogin;

class Home extends BaseController
{

    protected $db;

    public function __construct()
    {
        $this->db = new ModelLogin();
    }
    public function index()
    {
        return redirect()->to(base_url('login'));
    }

    public function login()
    {
        if(session('role'))
        {
            return redirect()->to('beranda');
        }
        return view('v_login');
    }

    public function loginProses()
    {
        $post = $this->request->getPost();
        $query = $this->db->table('ms_user')->getWhere(['username' => $post['username']]);
        $user = $query->getRow();
        if($user) {
            if($post['password'] == $user->password) {
                $params = ['role' => $user->role, 'nama' =>$user->nama];
                session()->set($params);
                return redirect()->to('/beranda')->with('login_suceess', 'Tambahkan Kategori dan Satuan terlebih dahulu sebelum menambahkan Barang baru');
            } elseif(password_verify($post['password'], $user->password)) {
                $params = ['role' => $user->role, 'nama' =>$user->nama];
                session()->set($params);
                return redirect()->to('/beranda');
            }else {
                return redirect()->back()->with('error', 'Password tidak sesuai');
            }
        } else {
            return redirect()->back()->with('error', 'Username tidak sesuai');
        }
    }

    public function logout()
    {
        session()->remove('role');
        return redirect()->to(base_url('/login'));
    }

}
