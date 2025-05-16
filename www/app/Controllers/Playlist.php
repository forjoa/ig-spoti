<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PlaylistModel;

class Playlist extends Controller {

    public function show($playlistId) {
        $model = new PlaylistModel();
        $playlist = $model->find($playlistId);

        // if (!$playlist) {
        //     return redirect()->to('/home')->with('error', 'Playlist not found');
        // }

        // $data = [
        //     'title' => $playlist['name'],
        //     'image' => $playlist['cover'],
        //     'tracks' => json_decode($playlist['tracks'], true),
        //     'name' => $playlist['name'],
        //     'artist_id' => $playlist['artist_id'],
        //     'artist_name' => $playlist['artist_name']
        // ];

        return view('playlist_details');
    }

}