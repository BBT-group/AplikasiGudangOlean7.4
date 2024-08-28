<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class UserController extends Controller
{
    public function changePasswordForm()
    {
        return view('v_ubah_password');
    }

    public function updatePassword()
    {
        $session = session();
        $userId = $session->get('id_ms_user'); // Assuming the session stores the user ID
        $userModel = new UserModel();

        $oldPassword = $this->request->getPost('old_password');
        $newPassword = $this->request->getPost('new_password');
        $confirmNewPassword = $this->request->getPost('confirm_new_password');

        // Verify the old password
        if (!$userModel->verifyPassword($userId, $oldPassword)) {
            return redirect()->back()->with('error', 'Old password is incorrect');
        }

        // Check if the new passwords match
        if ($newPassword !== $confirmNewPassword) {
            return redirect()->back()->with('error', 'New passwords do not match');
        }

        // Update the password
        $userModel->updatePassword($userId, $newPassword);

        return redirect()->to('/user/changePassword')->with('success', 'Password updated successfully');
    }
}
