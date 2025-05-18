<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Profile extends Controller
{
    public function index()
    {
        // if (!session()->get('isLoggedIn')) return redirect()->to('/');

        $model = new UserModel();
        $data['user'] = $model->find(session()->get('user_id'));

        echo view('profile', $data);
    }

    public function update()
    {
        helper(['form', 'url']);

        $userModel = new UserModel();
        $userId = session()->get('user_id');
        $user = $userModel->find($userId);

        if (!$user) {
            return redirect()->back()->with('error', 'Usuario no encontrado.');
        }

        $request = $this->request;
        $validation = \Config\Services::validation();

        $rules = [
            'username' => 'required|min_length[3]|max_length[50]',
            'age' => 'permit_empty|integer|greater_than_equal_to[0]',
            'profile_picture' => 'is_image[profile_picture]|max_size[profile_picture,2048]',
        ];

        $newPassword = $request->getPost('new_password');
        if (!empty($newPassword)) {
            $rules['current_password'] = 'required';
            $rules['new_password'] = 'required|min_length[6]';
            $rules['repeat_password'] = 'required|matches[new_password]';
        }

        if (!$this->validate($rules)) {
            return view('profile', [
                'user' => $user,
                'username_error' => $validation->getError('username'),
                'age_error' => $validation->getError('age'),
                'profile_picture_error' => $validation->getError('profile_picture'),
                'current_password_error' => $validation->getError('current_password'),
                'new_password_error' => $validation->getError('new_password'),
                'repeat_password_error' => $validation->getError('repeat_password'),
            ]);
        }

        $user['username'] = $request->getPost('username');
        $user['age'] = $request->getPost('age');

        $profilePicture = $request->getFile('profile_picture');
        if ($profilePicture && $profilePicture->isValid() && !$profilePicture->hasMoved()) {
            $newName = $profilePicture->getRandomName();
            $profilePicture->move(FCPATH . 'uploads', $newName);
            $user['profile_pic'] = $newName;
        }

        if (!empty($newPassword)) {
            if (!password_verify($request->getPost('current_password'), $user['password'])) {
                return view('profile', [
                    'user' => $user,
                    'current_password_error' => 'La contraseña actual es incorrecta',
                ]);
            }

            $user['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
        }

        $userModel->save($user);

        return view('profile', [
            'user' => $user,
            'success_message' => 'Perfil actualizado correctamente.'
        ]);
    }


    public function delete()
    {
        $model = new UserModel();
        $userId = session()->get('user_id');

        if ($model->delete($userId)) {
            session()->destroy();
            return redirect()->to('/')->with('success', 'User deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete user.');
        }
    }
}