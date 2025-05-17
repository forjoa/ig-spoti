<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use GuzzleHttp\Client;

class Artist extends Controller
{
    public function show($id)
    {
        // if (!session()->get('isLoggedIn')) return redirect()->to('/');

        $client = new Client();
        $response = $client->request('GET', "https://api.jamendo.com/v3.0/artists", [
            'query' => [
                'client_id' => '9a51a4c6',
                'id' => $id
            ]
        ]);
        $data['artist'] = json_decode($response->getBody(), true)['results'][0];

        $responseAlbums = $client->request('GET', "https://api.jamendo.com/v3.0/albums", [
            'query' => [
                'client_id' => '9a51a4c6',
                'artist_id' => $id,
            ]
        ]);
        $data['albums'] = json_decode($responseAlbums->getBody(), true)['results'];

        echo view('artist', $data);
    }
}