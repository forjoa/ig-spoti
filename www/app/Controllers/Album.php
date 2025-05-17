<?php namespace App\Controllers;

use CodeIgniter\Controller;
use GuzzleHttp\Client;

class Album extends Controller {
    public function show($id) {
        // if (!session()->get('isLoggedIn')) return redirect()->to('/');

        $client = new Client();
        $response = $client->request('GET', "https://api.jamendo.com/v3.0/albums/tracks/", [
            'query' => [
                'client_id' => '9a51a4c6',
                'id' => $id
            ]
        ]);
        $data['album'] = json_decode($response->getBody(), true)['results'][0];

        $data['tracks'] = $data['album']['tracks'];

        echo view('album', $data);
    }
}