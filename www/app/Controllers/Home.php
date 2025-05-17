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
        // Verifica si el usuario está autenticado
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/sign-in');
        }

        $client = new Client();
        $jamendoApiUrl = 'https://api.jamendo.com/v3.0/';
        $clientId = '9a51a4c6'; 

        // Obtiene los parámetros de búsqueda
        $search = $this->request->getGet('search');
        $type = $this->request->getGet('type') ?? 'track';

        $data = [
            'search' => $search,
            'type' => $type,
            'search_results' => [],
            'popular_playlists' => [],
            'featured_artists' => [],
            'recent_albums' => []
        ];

        try {
            if ($search) {
                // Realiza la búsqueda según el tipo seleccionado
                switch ($type) {
                    case 'track':
                        $response = $client->request('GET', $jamendoApiUrl . 'tracks/', [
                            'query' => [
                                'client_id' => $clientId,
                                'search' => $search,
                                'limit' => 20,
                                'format' => 'json',
                                'include' => 'musicinfo'
                            ]
                        ]);
                        $results = json_decode($response->getBody(), true)['results'];
                        $data['search_results'] = array_map(function ($track) {
                            return (object)[
                                'id' => $track['id'],
                                'name' => $track['name'],
                                'artist_id' => $track['artist_id'],
                                'artist_name' => $track['artist_name'],
                                'duration' => $track['duration']
                            ];
                        }, $results);
                        break;

                    case 'album':
                        $response = $client->request('GET', $jamendoApiUrl . 'albums/', [
                            'query' => [
                                'client_id' => $clientId,
                                'search' => $search,
                                'limit' => 20,
                                'format' => 'json'
                            ]
                        ]);
                        $results = json_decode($response->getBody(), true)['results'];
                        $data['search_results'] = array_map(function ($album) {
                            return (object)[
                                'id' => $album['id'],
                                'name' => $album['name'],
                                'image' => $album['image'],
                                'artist_id' => $album['artist_id'],
                                'artist_name' => $album['artist_name']
                            ];
                        }, $results);
                        break;

                    case 'artist':
                        $response = $client->request('GET', $jamendoApiUrl . 'artists/', [
                            'query' => [
                                'client_id' => $clientId,
                                'search' => $search,
                                'limit' => 20,
                                'format' => 'json'
                            ]
                        ]);
                        $results = json_decode($response->getBody(), true)['results'];
                        $data['search_results'] = array_map(function ($artist) {
                            return (object)[
                                'id' => $artist['id'],
                                'name' => $artist['name'],
                                'image' => $artist['image']
                            ];
                        }, $results);
                        break;

                    case 'playlist':
                        $response = $client->request('GET', $jamendoApiUrl . 'playlists/', [
                            'query' => [
                                'client_id' => $clientId,
                                'search' => $search,
                                'limit' => 20,
                                'format' => 'json'
                            ]
                        ]);
                        $results = json_decode($response->getBody(), true)['results'];
                        $data['search_results'] = array_map(function ($playlist) {
                            return (object)[
                                'id' => $playlist['id'],
                                'name' => $playlist['name'],
                                // 'image' => $playlist['image'],
                                // 'tracks_count' => $playlist['tracks_count']
                            ];
                        }, $results);
                        break;
                }
            } else {
                // Obtiene contenido destacado cuando no hay búsqueda

                // Playlists populares
                $response = $client->request('GET', $jamendoApiUrl . 'playlists/', [
                    'query' => [
                        'client_id' => $clientId,
                        'limit' => 8,
                        'format' => 'json'
                    ]
                ]);
                $results = json_decode($response->getBody(), true)['results'];
                $data['popular_playlists'] = array_map(function ($playlist) {
                    return (object)[
                        'id' => $playlist['id'],
                        'name' => $playlist['name'],
                        //'image' => $playlist['image'],
                        // 'tracks_count' => $playlist['tracks_count']
                    ];
                }, $results);

                // Artistas destacados
                $response = $client->request('GET', $jamendoApiUrl . 'artists/', [
                    'query' => [
                        'client_id' => $clientId,
                        'order' => 'popularity_total_desc',
                        'limit' => 8,
                        'format' => 'json'
                    ]
                ]);
                $results = json_decode($response->getBody(), true)['results'];
                $data['featured_artists'] = array_map(function ($artist) {
                    return (object)[
                        'id' => $artist['id'],
                        'name' => $artist['name'],
                        'image' => $artist['image']
                    ];
                }, $results);

                // Álbumes recientes
                $response = $client->request('GET', $jamendoApiUrl . 'albums/', [
                    'query' => [
                        'client_id' => $clientId,
                        'order' => 'popularity_total_desc',
                        'limit' => 8,
                        'format' => 'json'
                    ]
                ]);
                $results = json_decode($response->getBody(), true)['results'];
                $data['recent_albums'] = array_map(function ($album) {
                    return (object)[
                        'id' => $album['id'],
                        'name' => $album['name'],
                        'image' => $album['image'],
                        'artist_id' => $album['artist_id'],
                        'artist_name' => $album['artist_name']
                    ];
                }, $results);
            }
        } catch (\Exception $e) {
            // Manejo de errores
            log_message('error', 'Error al obtener datos de la API de Jamendo: ' . $e->getMessage());
            $data['error'] = 'Ocurrió un error al obtener los datos. Por favor, intenta nuevamente más tarde.';
        }

        return view('home', $data);
    }
}