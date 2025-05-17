<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music App - Inicio</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <header class="bg-indigo-600 text-white p-4">
            <div class="container mx-auto flex flex-col md:flex-row items-center justify-between">
                <a href="<?= base_url('home') ?>" class="text-3xl font-bold mb-4 md:mb-0">Music App</a>

                <div class="flex items-center space-x-6">
                    <a href="<?= base_url('my-playlists') ?>" class="hover:text-indigo-200">Mis Playlists</a>
                    <a href="<?= base_url('profile') ?>" class="hover:text-indigo-200">Mi Perfil</a>
                    <a href="<?= base_url('logout') ?>"
                        class="bg-indigo-700 px-4 py-2 rounded-md hover:bg-indigo-800">Cerrar Sesión</a>
                </div>
            </div>
        </header>

        <div class="container mx-auto px-4 py-6">
            <form action="<?= base_url('home') ?>" method="GET" class="mb-8">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-grow">
                        <input type="text" name="search" placeholder="Buscar música, artistas, álbumes o playlists..."
                            class="w-full px-4 py-3 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            value="<?= isset($search) ? $search : '' ?>">
                    </div>

                    <div class="flex gap-2">
                        <select name="type"
                            class="px-4 py-3 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="track" <?= (isset($type) && $type === 'track') ? 'selected' : '' ?>>Canciones
                            </option>
                            <option value="album" <?= (isset($type) && $type === 'album') ? 'selected' : '' ?>>Álbumes
                            </option>
                            <option value="artist" <?= (isset($type) && $type === 'artist') ? 'selected' : '' ?>>Artistas
                            </option>
                            <option value="playlist" <?= (isset($type) && $type === 'playlist') ? 'selected' : '' ?>>
                                Playlists</option>
                        </select>

                        <button type="submit"
                            class="bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700 transition">
                            Buscar
                        </button>
                    </div>
                </div>
            </form>

            <?php if (isset($search_results) && !empty($search_results)): ?>
                <div class="mb-8">
                    <h2 class="text-2xl font-bold mb-4">Resultados de búsqueda para "<?= $search ?>"</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        <?php foreach ($search_results as $result): ?>
                            <?php if ($type === 'track'): ?>
                                <div class="bg-white rounded-lg shadow overflow-hidden">
                                    <div class="p-4">
                                        <h3 class="font-bold text-lg mb-1"><?= $result->name ?></h3>
                                        <p class="text-gray-600 mb-2">
                                            <a href="<?= base_url('artist/' . $result->artist_id) ?>"
                                                class="hover:underline"><?= $result->artist_name ?></a>
                                        </p>
                                        <div class="flex justify-between items-center">
                                            <span class="text-gray-500"><?= gmdate("i:s", $result->duration) ?></span>
                                            <button class="text-indigo-600 hover:text-indigo-800"
                                                onclick="addToPlaylist(<?= $result->id ?>)">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 4v16m8-8H4" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php elseif ($type === 'album'): ?>
                                <a href="<?= base_url('album/' . $result->id) ?>"
                                    class="bg-white rounded-lg shadow overflow-hidden block hover:shadow-lg transition">
                                    <img src="<?= $result->image == '' ? base_url('unknown-music.jpg') :  $result->image?>" alt="<?= $result->name ?>" class="w-full h-48 object-cover">
                                    <div class="p-4">
                                        <h3 class="font-bold text-lg mb-1"><?= $result->name ?></h3>
                                        <p class="text-gray-600">
                                            <?= $result->artist_name ?>
                                        </p>
                                    </div>
                                </a>
                            <?php elseif ($type === 'artist'): ?>
                                <a href="<?= base_url('artist/' . $result->id) ?>"
                                    class="bg-white rounded-lg shadow overflow-hidden block hover:shadow-lg transition">
                                    <img src="<?= $result->image == '' ? base_url('unknown-artist.png') : $result->image ?>" alt="<?= $result->name ?>" class="w-full h-48 object-cover">
                                    <div class="p-4">
                                        <h3 class="font-bold text-lg"><?= $result->name ?></h3>
                                    </div>
                                </a>
                            <?php elseif ($type === 'playlist'): ?>
                                <a href="<?= base_url('playlist/' . $result->id) ?>"
                                    class="bg-white rounded-lg shadow overflow-hidden block hover:shadow-lg transition">
                                    <img src="<?= base_url('unknown-music.jpg') ?>" alt="<?= $result->name ?>" class="w-full h-48 object-cover">
                                    <div class="p-4">
                                        <h3 class="font-bold text-lg mb-1"><?= $result->name ?></h3>
                                        <p class="text-gray-600"><?= $result->tracks_count ?? 'Muchas' ?> canciones</p>
                                    </div>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div>
                <h2 class="text-2xl font-bold mb-4">Descubre</h2>

                <div class="mb-8">
                    <h3 class="text-xl font-bold mb-3">Playlists populares</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        <?php if (empty($popular_playlists)) { ?>
                            <p class="text-gray-500">No hay playlists populares en este momento.</p>
                        <?php } else { ?>
                            <?php foreach ($popular_playlists as $playlist): ?>
                                <a href="<?= base_url('playlist/' . $playlist->id) ?>"
                                    class="bg-white rounded-lg shadow overflow-hidden block hover:shadow-lg transition">
                                    
                                        <img src="<?= $playlist->image ?? base_url('unknown-music.jpg') ?>" alt="<?= $playlist->name ?>" class="w-full h-48 object-cover">
                                    <div class="p-4">
                                        <h4 class="font-bold text-lg mb-1"><?= $playlist->name ?></h4>
                                        <p class="text-gray-600"><?= $playlist->tracks_count ?? 'Muchas' ?> canciones</p>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        <?php } ?>
                    </div>
                </div>

                <div class="mb-8">
                    <h3 class="text-xl font-bold mb-3">Artistas destacados</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6">
                        <?php if (empty($featured_artists)) { ?>
                            <p class="text-gray-500">No hay artistas destacados en este momento.</p>
                        <?php } else { ?>
                            <?php foreach ($featured_artists as $artist): ?>
                                <a href="<?= base_url('artist/' . $artist->id) ?>" class="text-center">
                                    <div class="w-32 h-32 mx-auto rounded-full overflow-hidden mb-2">
                                        <img src="<?= $artist->image == '' ? base_url('unknown-artist.png') : $artist->image ?>" alt="<?= $artist->name ?>"
                                            class="w-full h-full object-cover">
                                    </div>
                                    <h4 class="font-medium"><?= $artist->name ?></h4>
                                </a>
                            <?php endforeach; ?>
                        <?php } ?>
                    </div>
                </div>

                <div>
                    <h3 class="text-xl font-bold mb-3">Álbumes recientes</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        <?php if (empty($recent_albums)) { ?>
                            <p class="text-gray-500">No hay álbumes recientes en este momento.</p>
                        <?php } else { ?>
                            <?php foreach ($recent_albums as $album): ?>
                                <a href="<?= base_url('album/' . $album->id) ?>" class="bg-white rounded-lg shadow overflow-hidden block hover:shadow-lg transition">
                                    <img src="<?= $album->image ?>" alt="<?= $album->name ?>" class="w-full h-48 object-cover" />
                                    <div>
                                        <h4 class="font-bold text-lg mb-1 px-6 py-4"><?= $album->name ?></h4>
                                        <p class="text-gray-600 px-6 pb-4"><?= $album->artist_name ?></p>
                                    </div>
                                </a>
                            <?php endforeach; ?>

                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <footer class="bg-gray-800 text-white py-4 mt-auto">
            <div class="container mx-auto px-4 text-center">
                <p>&copy; 2025 Music App. Todos los derechos reservados.</p>
            </div>
        </footer>
    </div>

    <!-- Modal para añadir canción a playlist -->
    <div id="add-to-playlist-modal"
        class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-lg p-6 max-w-md w-full">
            <h3 class="text-xl font-bold mb-4">Añadir a playlist</h3>

            <p class="mb-4">Selecciona la playlist a la que quieres añadir esta canción:</p>

            <div class="max-h-60 overflow-y-auto mb-4">
                <div id="playlist-list" class="space-y-2">
                    <!-- Lista de playlists del usuario -->
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <button onclick="closeAddToPlaylistModal()"
                    class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-100">
                    Cancelar
                </button>
                <button onclick="confirmAddToPlaylist()"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                    Añadir
                </button>
            </div>
        </div>
    </div>

    <script>
        let currentTrackId = null;
        let selectedPlaylistId = null;

        function addToPlaylist(trackId) {
            currentTrackId = trackId;

            // Petición AJAX para obtener las playlists del usuario 
            fetch('<?= base_url('api/my-playlists') ?>')
                .then(response => response.json())
                .then(data => {
                    const playlistListEl = document.getElementById('playlist-list');
                    playlistListEl.innerHTML = '';

                    if (data.length === 0) {
                        playlistListEl.innerHTML = '<p class="text-gray-500">No tienes playlists. <a href="<?= base_url('create-playlist') ?>" class="text-indigo-600 hover:underline">Crea una nueva</a>.</p>';
                    } else {
                        data.forEach(playlist => {
                            const div = document.createElement('div');
                            div.className = 'p-2 border border-gray-200 rounded-md cursor-pointer hover:bg-gray-50';
                            div.dataset.id = playlist.id;
                            div.innerHTML = `
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded overflow-hidden">
                                        <img src="${playlist.cover}" alt="${playlist.name}" class="w-full h-full object-cover">
                                    </div>
                                    <span>${playlist.name}</span>
                                </div>
                            `;
                            div.addEventListener('click', () => {
                                document.querySelectorAll('#playlist-list > div').forEach(el => {
                                    el.classList.remove('border-indigo-600', 'bg-indigo-50');
                                });
                                div.classList.add('border-indigo-600', 'bg-indigo-50');
                                selectedPlaylistId = playlist.id;
                            });
                            playlistListEl.appendChild(div);
                        });
                    }

                    document.getElementById('add-to-playlist-modal').classList.remove('hidden');
                    document.getElementById('add-to-playlist-modal').classList.add('flex');
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function closeAddToPlaylistModal() {
            document.getElementById('add-to-playlist-modal').classList.remove('flex');
            document.getElementById('add-to-playlist-modal').classList.add('hidden');
            selectedPlaylistId = null;
        }

        function confirmAddToPlaylist() {
            if (!selectedPlaylistId) {
                alert('Selecciona una playlist primero');
                return;
            }

            // Petición AJAX para añadir la canción a la playlist
            fetch(`<?= base_url('my-playlists/') ?>${selectedPlaylistId}/track/${currentTrackId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                }
            })
                .then(response => {
                    if (response.ok) {
                        closeAddToPlaylistModal();
                        alert('Canción añadida a la playlist');
                    } else {
                        throw new Error('No se pudo añadir la canción a la playlist');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al añadir la canción a la playlist');
                });
        }
    </script>
</body>

</html>