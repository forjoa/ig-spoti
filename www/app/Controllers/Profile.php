<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Profile extends Controller {
    public function index() {
        if (!session()->get('isLoggedIn')) return redirect()->to('/');

        $model = new UserModel();
        $data['user'] = $model->find(session()->get('user_id'));

        echo view('layout', [
            'title' => lang('App.profile.title'),
            'content' => view('profile', $data)
        ]);
    }

    public function update() {
        // Handle password update, profile picture upload, etc.
    }
}