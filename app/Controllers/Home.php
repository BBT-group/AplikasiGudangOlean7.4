<?php

namespace App\Controllers;

use App\Models\ModelLogin;
use App\Models\UserSessionModel;

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
        if (session('role')) {
            return redirect()->to('beranda');
        }
        return view('v_login');
    }

    public function loginProses()
    {
        $post = $this->request->getPost();
        $query = $this->db->table('ms_user')->getWhere(['username' => $post['username']]);
        $user = $query->getRow();

        if ($user) {

            if ($user->status == 1) {
                $usersession = new UserSessionModel();
                date_default_timezone_set('UTC');
                $currentTime = date('Y-m-d H:i:s');
                $user1 = $usersession->where('id_ms_user', $user->id_ms_user)->first();
                if (strtotime($currentTime) - strtotime($user1['waktu']) > (31 * 60)) {
                    $usersession->where('id_user_session', $user1['id_user_session'])->delete();
                    $this->db->update($user->id_ms_user, ['last_login' => date('Y-m-d H:i:s'), 'status' => '0']);
                } else {
                    return redirect()->back()->with('error', 'User sedang login');
                }
            }
            if ($post['password'] == $user->password) {
                $params = ['user_id' => $user->id_ms_user, 'role' => $user->role, 'nama' => $user->nama];
                $this->db->update($user->id_ms_user, ['last_login' => date('Y-m-d H:i:s'), 'status' => '1']);
                session()->set($params);
                return redirect()->to('/beranda')->with('login_suceess', 'Tambahkan Kategori dan Satuan terlebih dahulu sebelum menambahkan Barang baru');
            } elseif (password_verify($post['password'], $user->password)) {
                $params = ['user_id' => $user->id_ms_user, 'role' => $user->role, 'nama' => $user->nama];
                $this->db->update($user->id_ms_user, ['last_login' => date('Y-m-d H:i:s'), 'status' => '1']);
                session()->set($params);
                return redirect()->to('/beranda');
            } else {
                return redirect()->back()->with('error', 'Password tidak sesuai');
            }
        } else {
            return redirect()->back()->with('error', 'Username tidak sesuai');
        }
    }

    public function logout()
    {
        $usersession = new UserSessionModel();
        $usersession->where('id_ms_user',  session()->get('user_id'))->delete();
        $this->db->where('id_ms_user', session()->get('user_id'))->update(session()->get('user_id'), ['status' => '0']);
        session()->destroy();
        return redirect()->to(base_url('/login'));
    }
}
