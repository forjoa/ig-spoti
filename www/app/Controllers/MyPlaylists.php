<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PlaylistModel;

class MyPlaylists extends Controller {
    public function index() {
        if (!session()->get('isLoggedIn')) return redirect()->to('/');

        $model = new PlaylistModel();
        $data['playlists'] = $model->where('user_id', session()->get('user_id'))->findAll();

        echo view('layout', [
            'title' => lang('App.my_playlists.title'),
            'content' => view('my_playlists', $data)
        ]);
    }

    public function create() {
        // Crear nueva playlist
        $model = new PlaylistModel();
        $model->save([
            'user_id' => session()->get('user_id'),
            'name' => $this->request->getPost('name'),
            'cover' => $this->request->getPost('cover') ?? 'default.jpg',
            'tracks' => json_encode([])
        ]);
        return redirect()->to('/my-playlists');
    }
    
    public function addTrack($playlistId, $trackId) {
        // Añadir track a una playlist existente
    }
}