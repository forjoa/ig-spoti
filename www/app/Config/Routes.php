<?php

use App\Controllers\Auth;
use App\Controllers\Home;
use App\Controllers\Profile;
use App\Controllers\Artist;
use App\Controllers\Album;
use App\Controllers\Playlist;
use App\Controllers\MyPlaylists;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(false); // o true si deseas habilitar el auto-ruteo

// Landing Page (usa el método index de Home para usuarios no logueados)
$routes->get('/', [Home::class, 'index']);

// Autenticación
$routes->get('/sign-in', [Auth::class, 'signIn']);
$routes->post('/sign-in', [Auth::class, 'handleSignIn']);
$routes->get('/sign-up', [Auth::class, 'signUp']);
$routes->post('/sign-up', [Auth::class, 'handleSignUp']);

// Rutas protegidas (requieren autenticación)
// $routes->group('', ['filter' => 'auth'], static function ($routes) {
// Home y Búsqueda
$routes->get('/home', [Home::class, 'home']);
$routes->get('/search', [Home::class, 'search']);

// Perfil de Usuario
$routes->get('/profile', [Profile::class, 'index']);
$routes->post('/profile/update', [Profile::class, 'update']);
$routes->post('/profile/delete', [Profile::class, 'delete']);

// Artistas y Álbumes
$routes->get('/artist/(:num)', [Artist::class, 'show']);
$routes->get('/album/(:num)', [Album::class, 'show']);

// Playlists Públicas
$routes->get('/playlist/(:num)', [Playlist::class, 'show']);

// Mis Playlists
$routes->get('/create-playlist', [MyPlaylists::class, 'createView']);
$routes->post('/create-playlist', [MyPlaylists::class, 'create']);

$routes->get('/my-playlists', [MyPlaylists::class, 'index']);
$routes->get('/my-playlists/(:num)', [MyPlaylists::class, 'show']);

$routes->put('/my-playlists/(:num)', [MyPlaylists::class, 'update']);
$routes->post('/my-playlists/(:num)', [MyPlaylists::class, 'delete']);
$routes->post('/my-playlists/(:num)/tracks', [MyPlaylists::class, 'addTrack']);

$routes->delete('/my-playlists/(:num)/track', [MyPlaylists::class, 'removeTrack']);
// });

// Cierre de Sesión (accesible para todos)
$routes->get('/logout', [Auth::class, 'logout']);

// Manejo de errores 404
$routes->set404Override(static function () {
    return view('errors/404');
});