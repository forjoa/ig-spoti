<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Landing Page (usa el método index de Home para usuarios no logueados)
$routes->get('/', 'Home::index');

// Autenticación
$routes->get('/sign-in', 'Auth::signIn');
$routes->post('/sign-in', 'Auth::handleSignIn');
$routes->get('/sign-up', 'Auth::signUp');
$routes->post('/sign-up', 'Auth::handleSignUp');


// Rutas protegidas (requieren autenticación)
$routes->group('', ['filter' => 'auth'], static function ($routes) {
    // Home y Búsqueda
    $routes->get('/home', 'Home::home'); // Método home() en el controlador Home
    $routes->get('/search', 'Home::search'); // Método search() para resultados de búsqueda

    // Perfil de Usuario
    $routes->get('/profile', 'Profile::index');
    $routes->post('/profile/update', 'Profile::update');
    $routes->post('/profile/delete', 'Profile::delete');

    // Artistas y Álbumes
    $routes->get('/artist/(:num)', 'Artist::show/$1');
    $routes->get('/album/(:num)', 'Album::show/$1');

    // Playlists Públicas
    $routes->get('/playlist/(:num)', 'Playlist::show/$1');

    // Mis Playlists
    $routes->get('/my-playlists', 'MyPlaylists::index');
    $routes->get('/my-playlists/(:num)', 'MyPlaylists::show/$1');
    $routes->post('/create-playlist', 'MyPlaylists::create');
    $routes->put('/my-playlists/(:num)', 'MyPlaylists::update/$1');
    $routes->delete('/my-playlists/(:num)', 'MyPlaylists::delete/$1');
    $routes->put('/my-playlists/(:num)/track/(:num)', 'MyPlaylists::addTrack/$1/$2');
    $routes->delete('/my-playlists/(:num)/track/(:num)', 'MyPlaylists::removeTrack/$1/$2');
});

// Cierre de Sesión (accesible para todos)
$routes->get('/logout', 'Auth::logout');

// Manejo de errores 404
$routes->set404Override(static function () {
    return view('errors/404');
});