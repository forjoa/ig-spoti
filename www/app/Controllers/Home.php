<?php namespace App\Controllers;

use CodeIgniter\Controller;
use GuzzleHttp\Client;

class Home extends Controller {
    public function index() {
        $data = [
            'title' => 'Welcome to LSpoty',
            'content' => view('landing')
        ];
    
        return view('landing');
    }
    public function home() {
        // if (!session()->get('isLoggedIn')) return redirect()->to('/sign-in');
        // $data = [];
        // $client = new Client();
        // $query = $this->request->getGet('query');

        // // Trending content (example)
        // if (!$query) {
        //     $response = $client->request('GET', 'https://api.jamendo.com/v3.0/albums/', [
        //         'query' => [
        //             'client_id' => '9a51a4c6',
        //             'limit' => 6,
        //             'order' => 'popularity_total'
        //         ]
        //     ]);
        //     $data['trending'] = json_decode($response->getBody(), true)['results'];
        // } else {
        //     // Search results
        //     $response = $client->request('GET', 'https://api.jamendo.com/v3.0/tracks/', [
        //         'query' => [
        //             'client_id' => '9a51a4c6',
        //             'search' => $query,
        //             'limit' => 10
        //         ]
        //     ]);
        //     $data['results'] = json_decode($response->getBody(), true)['results'];
        // }

        echo view('home');
    }
}