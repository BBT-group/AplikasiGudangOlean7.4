<?php
// app/Filters/InactivityMiddleware.php

namespace App\Filters;

use App\Models\ModelLogin;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Inactivity implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {

        // Set inactivity timeout in seconds (10 minutes)
        $timeout = 10 * 60;

        // Check if 'lastActivity' exists in session
        if (session()->has('lastActivity') && session()->has('role')) {
            $lastActivity = session()->get('lastActivity');
            $currentTime = time();

            // If the difference is greater than timeout, destroy the session
            if (($currentTime - $lastActivity) > $timeout) {

                $db = new ModelLogin();
                $db->update(session()->get('user_id'), ["status" => '0']);

                session()->destroy(); // Destroy session if inactive for 10 minutes
                return redirect()->to('/login')->with('error', 'Your session has expired. Please log in again.');
            }
        }
        if (session()->has('role')) {
            // Update 'lastActivity' time in session
            session()->set('lastActivity', time());
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No after action needed
    }
}
