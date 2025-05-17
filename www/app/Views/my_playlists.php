<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music App - Mi Perfil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <header class="bg-indigo-600 text-white p-4">
            <div class="container mx-auto flex flex-col md:flex-row items-center justify-between">
                <a href="<?= base_url('home') ?>" class="text-3xl font-bold mb-4 md:mb-0">Music App</a>

                <div class="flex items-center space-x-6">
                    <a href="<?= base_url('my-playlists') ?>" class="hover:text-indigo-200 font-bold">Mis Playlists</a>
                    <a href="<?= base_url('profile') ?>" class="hover:text-indigo-200">Mi Perfil</a>
                    <a href="<?= base_url('logout') ?>"
                        class="bg-indigo-700 px-4 py-2 rounded-md hover:bg-indigo-800">Cerrar Sesión</a>
                </div>
            </div>
        </header>

        <main class="flex-grow container mx-auto py-8 px-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Mis Playlists</h2>
                <a href="<?= base_url('create-playlist') ?>"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Crear Playlist
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <?php if (empty($playlists)) { ?>
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4 text-center">
                        <p class="text-gray-500">No tienes playlists creadas.</p>
                    </div>
                <?php } else { ?>
                    <?php foreach ($playlists as $playlist): ?>
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                            <a href="<?= base_url('my-playlists/' . $playlist['id']) ?>">
                                <img src="<?= $playlist['cover'] == '' ? base_url('unknown-music.jpg') : base_url('uploads/'.$playlist['cover']) ?>"
                                    alt="<?= $playlist['name'] ?>" class="w-full h-48 object-cover">
                            </a>
                            <div class="p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-bold text-lg mb-1"><?= $playlist['name'] ?></h3>
                                        <p class="text-gray-600 text-sm"><?= $playlist['track_count'] ?? 'Muchas' ?> canciones</p>
                                    </div>
                                    <button class="bg-indigo-600 rounded-full p-2 text-white hover:bg-indigo-700 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php } ?>
            </div>

            <!-- Detalle de Playlist Seleccionada (se muestra cuando se selecciona una playlist) -->
            <?php if (isset($selected_playlist)): ?>
                <div class="mt-12 bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold"><?= $selected_playlist->name ?></h2>
                            <div class="flex gap-2">
                                <button id="renamePlaylist"
                                    class="border border-indigo-600 text-indigo-600 px-4 py-2 rounded-md hover:bg-indigo-50 transition">
                                    Renombrar
                                </button>
                                <button id="deletePlaylist"
                                    class="border border-red-600 text-red-600 px-4 py-2 rounded-md hover:bg-red-50 transition">
                                    Eliminar
                                </button>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-xl font-semibold">Canciones</h3>
                                <div class="flex gap-2">
                                    <button id="playButton"
                                        class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition flex items-center">
                                        <svg id="playIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        </svg>
                                        <span id="playText">Reproducir</span>
                                    </button>
                                    <button id="repeatButton"
                                        class="border border-indigo-600 text-indigo-600 px-4 py-2 rounded-md hover:bg-indigo-50 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="relative pt-1">
                                    <div class="overflow-hidden h-2 mb-1 text-xs flex rounded bg-gray-200">
                                        <div id="progressBar"
                                            class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-indigo-600"
                                            style="width: 0%"></div>
                                    </div>
                                    <div class="flex justify-between text-xs text-gray-500">
                                        <span id="currentTime">0:00</span>
                                        <span id="totalTime">0:00</span>
                                    </div>
                                </div>
                            </div>

                            <div class="divide-y">
                                <?php foreach ($selected_playlist_tracks as $index => $track): ?>
                                    <div
                                        class="flex items-center py-3 px-2 hover:bg-gray-100 group <?= $index === 0 ? 'bg-indigo-50' : '' ?>">
                                        <div class="w-8 text-center text-gray-500"><?= $index + 1 ?></div>
                                        <div class="flex-grow px-4">
                                            <p class="font-medium"><?= $track->name ?></p>
                                            <p class="text-sm text-gray-500"><?= $track->artist_name ?></p>
                                        </div>
                                        <div class="text-gray-500"><?= $track->duration ?></div>
                                        <div class="ml-4">
                                            <?php if ($index === 0): ?>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </main>

        <footer class="bg-gray-800 text-white py-4 mt-auto">
            <div class="container mx-auto px-4 text-center">
                <p>&copy; 2025 Music App. Todos los derechos reservados.</p>
            </div>
        </footer>
    </div>
</body>

</html>