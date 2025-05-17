<?php
namespace App\Controllers;

use App\Models\TrackModel;
use CodeIgniter\Controller;
use App\Models\PlaylistModel;

class MyPlaylists extends Controller
{
    public function index()
    {
        // if (!session()->get('isLoggedIn')) return redirect()->to('/');

        $model = new PlaylistModel();
        $data['playlists'] = $model->where('user_id', session()->get('user_id'))->findAll();

        echo view('my_playlists', $data);
    }

    public function createView()
    {
        // if (!session()->get('isLoggedIn')) return redirect()->to('/');

        echo view('create_playlist');
    }

    public function create()
    {
        $cover = $this->request->getFile('cover');
        $coverName = '';

        if ($cover && $cover->isValid() && !$cover->hasMoved()) {
            $coverName = $cover->getRandomName();
            $cover->move(FCPATH . 'uploads', $coverName);
        }

        $model = new PlaylistModel();
        $model->save([
            'user_id' => session()->get('user_id'),
            'name' => $this->request->getPost('name'),
            'cover' => $coverName,
        ]);

        return redirect()->to('/my-playlists');
    }

    public function show($playlistId)
    {
        $playlistModel = new PlaylistModel();
        $trackModel = new TrackModel();

        // Obtener la playlist por su ID
        $playlist = $playlistModel->find($playlistId);

        // Verificar si la playlist existe
        if (!$playlist) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Playlist no encontrada');
        }

        // Verificar que el usuario actual es el propietario de la playlist
        if ($playlist['user_id'] !== session()->get('user_id')) {
            return redirect()->to('/my-playlists')->with('error', 'No tienes permiso para ver esta playlist.');
        }

        // Obtener las canciones asociadas a la playlist
        $tracks = $trackModel
            ->select()
            ->where('playlist_id', $playlistId)
            ->findAll();

        // Preparar los datos para la vista
        $data = [
            'playlist' => $playlist,
            'tracks' => $tracks,
        ];

        // Cargar la vista
        return view('my_playlist_details', $data);
    }

    public function delete($playlistId)
    {
        $model = new PlaylistModel();
        $model->delete($playlistId);

        return redirect()->to('my-playlists');
    }

    public function addTrack($playlistId, $trackId)
    {
        // Añadir track a una playlist existente
    }
}