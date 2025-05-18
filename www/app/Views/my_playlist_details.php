<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($playlist['name']) ?> - Mi Playlist</title>
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

        <main class="flex-grow container max-w-7xl mx-auto px-4 py-6">
            <div class="bg-white p-6 rounded-lg shadow mb-6">
                <div class="flex items-center justify-between">
                    <div class="mt-4 flex items-center gap-4">
                        <img src="<?= $playlist['cover'] ? base_url('uploads/' . esc($playlist['cover'])) : base_url('unknown-music.jpg') ?>"
                            alt="Portada de la playlist" class="w-full h-64 max-w-64  object-cover rounded">
                        <h2 class="text-2xl font-semibold"><?= esc($playlist['name']) ?></h2>
                    </div>
                    <div class="flex space-x-2">
                        <a href="<?= base_url('my-playlists') ?>"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">Volver</a>
                        <form action="<?= base_url('my-playlists/' . $playlist['id']) ?>" method="post"
                            onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta playlist?');">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="delete">
                            <button type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">Eliminar</button>
                        </form>
                    </div>
                </div>

            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold mb-4">Canciones</h3>
                <?php if (!empty($tracks)): ?>
                    <ul class="divide-y divide-gray-200">
                        <?php foreach ($tracks as $index => $track): ?>
                            <div class="flex items-center py-3 px-2 hover:bg-gray-100 group">
                                <div class="w-8 text-center text-gray-500"><?= $index + 1 ?></div>
                                <div class="flex-grow px-4">
                                    <p class="font-medium"><?= esc($track['name']) ?></p>
                                    <p class="text-sm text-gray-500"><?= esc($track['artist_name']) ?></p>
                                </div>
                                <div class="text-gray-500"><?= gmdate("i:s", $track['duration']) ?></div>
                                <div class="ml-4 opacity-0 group-hover:opacity-100 transition flex items-center space-x-2">
                                    <form action="<?= base_url('my-playlists/' . $playlist['id'] . '/track') ?>"
                                        method="post" onsubmit="return confirm('¿Eliminar esta canción de la playlist?');">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="track_id" value="<?= esc($track['id']) ?>">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="text-red-600 hover:text-red-700">
                                            Eliminar
                                        </button>
                                    </form>
                                    <button class="text-indigo-600 hover:text-indigo-800" type="button" aria-label="Reproducir">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-gray-500">Esta playlist no tiene canciones aún.</p>
                <?php endif; ?>
            </div>

            <div class="mt-6 bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold mb-4">Agregar canción</h3>
                <form action="<?= base_url('my-playlists/' . $playlist['id']) . '/tracks' ?>" method="post"
                    class="flex items-center space-x-4">
                    <?= csrf_field() ?>
                    <input type="number" name="track_id" placeholder="ID de la canción" required
                        class="w-1/3 px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">Agregar
                        canción</button>
                </form>
            </div>
        </main>

        <footer class="bg-gray-800 text-white py-4 mt-auto">
            <div class="container mx-auto px-4 text-center">
                <p>&copy; 2025 Music App. Todos los derechos reservados.</p>
            </div>
        </footer>
    </div>
</body>

</html>