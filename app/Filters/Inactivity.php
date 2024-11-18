<?php
// app/Filters/InactivityMiddleware.php

namespace App\Filters;

use App\Models\ModelLogin;
use App\Models\UserSessionModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Inactivity implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $db = new ModelLogin();
        $usersession = new UserSessionModel();
        // Set inactivity timeout in seconds (10 minutes)
        $timeout = 30 * 60;
        $user = $usersession->where('id_ms_user', session()->get('user_id'))->first();
        // Check if 'lastActivity' exists in session  
        date_default_timezone_set('UTC');
        $currentTime1 = date('Y-m-d H:i:s');

        if ($user) {
            if (session()->has('lastActivity') && session()->has('role')) {
                $lastActivity = session()->get('lastActivity');
                $currentTime = time();

                // If the difference is greater than timeout, destroy the session
                if (($currentTime - $lastActivity) > $timeout) {
                    $db->where('id_ms_user', session()->get('user_id'))->update(session()->get('user_id'), ["status" => '0']);
                    $usersession->where('id_user_session', $user['id_user_session'])->delete();
                    session()->destroy(); // Destroy session if inactive for 10 minutes
                    return redirect()->to('/login')->with('error', 'Your session has expired. Please log in again.');
                }
            }
            if (session()->has('role')) {;
                $usersession->where('id_user_session', $user['id_user_session'])->update($user['id_user_session'], ['waktu' => $currentTime1]);
                session()->set('lastActivity', time());
            }
        } else {
            if (session()->has('role')) {
                $usersession->insert(['waktu' => $currentTime1, 'id_ms_user' => session()->get('user_id')]);
                session()->set('lastActivity', time());
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No after action needed
    }
}
