<?php
namespace App\Controllers;

use App\Models\TrackModel;
use CodeIgniter\Controller;
use App\Models\PlaylistModel;
use GuzzleHttp\Client;

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

        $playlist = $playlistModel->find($playlistId);

        if (!$playlist) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Playlist no encontrada');
        }

        if ($playlist['user_id'] !== session()->get('user_id')) {
            return redirect()->to('/my-playlists')->with('error', 'No tienes permiso para ver esta playlist.');
        }

        $tracks = $trackModel
            ->select()
            ->where('playlist_id', $playlistId)
            ->findAll();

        $data = [
            'playlist' => $playlist,
            'tracks' => $tracks,
        ];

        return view('my_playlist_details', $data);
    }

    public function delete($playlistId)
    {
        $model = new PlaylistModel();
        $model->delete($playlistId);

        return redirect()->to('my-playlists');
    }

    public function addTrack($playlistId)
    {
        $trackId = $this->request->getPost('track_id');

        $playlistModel = new PlaylistModel();
        $playlist = $playlistModel->find($playlistId);

        if (!$playlist) {
            return redirect()->back()->with('error', 'Playlist no encontrada');
        }

        $client = new Client();
        $response = $client->get("https://api.jamendo.com/v3.0/tracks", [
            'query' => [
                'client_id' => '9a51a4c6',
                'id' => $trackId,
                'format' => 'json'
            ]
        ]);

        $result = json_decode($response->getBody(), true);

        if (empty($result['results']) || !isset($result['results'][0])) {
            return redirect()->back()->with('error', 'Canción no encontrada en Jamendo');
        }

        $trackData = $result['results'][0];

        $trackModel = new TrackModel();
        $existingTrack = $trackModel->where('id', $trackId)->first();

        if (!$existingTrack) {
            $trackModel->insert([
                'id' => $trackData['id'],
                'name' => $trackData['name'],
                'cover' => $trackData['album_image'],
                'artist_id' => $trackData['artist_id'],
                'artist_name' => $trackData['artist_name'],
                'album_id' => $trackData['album_id'],
                'album_name' => $trackData['album_name'],
                'duration' => $trackData['duration'],
                'player_url' => $trackData['audio'],
                'playlist_id' => (int) $playlistId
            ]);
        } else {
            if ($existingTrack['playlist_id'] != $playlistId) {
                $trackModel->update($trackId, ['playlist_id' => $playlistId]);
            }
        }

        return redirect()->back()->with('success', 'Canción agregada correctamente');
    }

    public function removeTrack($playlistId)
    {
        $trackId = $this->request->getPost('track_id');
        
        $trackModel = new TrackModel();
        $trackModel->delete($trackId);

        return redirect()->back()->with('success', 'Canción eliminada correctamente');
    }

}