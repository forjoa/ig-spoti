<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PlaylistModel;
use GuzzleHttp\Client;

class Playlist extends Controller {

    public function show($playlistId) {
        // $model = new PlaylistModel();
        // $playlist = $model->find($playlistId);

        // if (!$playlist) {
        //     return redirect()->to('/home')->with('error', 'Playlist not found');
        // }

        $client = new Client();
        $response = $client->request('GET', "https://api.jamendo.com/v3.0/playlists/tracks", [
            'query' => [
                'client_id' => '9a51a4c6',
                'id' => $playlistId
            ]
        ]);
        $data['playlist'] = json_decode($response->getBody(), true)['results'][0];
        $data['tracks'] = $data['playlist']['tracks'];

        // $data = [
        //     'title' => $playlist['name'],
        //     'image' => $playlist['cover'],
        //     'tracks' => json_decode($playlist['tracks'], true),
        //     'name' => $playlist['name'],
        //     'artist_id' => $playlist['artist_id'],
        //     'artist_name' => $playlist['artist_name']
        // ];

        return view('playlist_details', $data);
    }

}