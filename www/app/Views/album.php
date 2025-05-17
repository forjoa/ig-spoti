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
                    <a href="<?= base_url('my-playlists') ?>" class="hover:text-indigo-200">Mis Playlists</a>
                    <a href="<?= base_url('profile') ?>" class="hover:text-indigo-200">Mi Perfil</a>
                    <a href="<?= base_url('logout') ?>"
                        class="bg-indigo-700 px-4 py-2 rounded-md hover:bg-indigo-800">Cerrar Sesión</a>
                </div>
            </div>
        </header>

        <main class="flex-grow container mx-auto py-8 px-4">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="md:flex">
                    <div class="md:w-1/3">
                        <img src="<?= $album['image'] ?? base_url('unknown-music.jpg') ?>"
                            alt="<?= $album['name'] ?? '' ?>" class="w-full h-auto object-cover">
                    </div>
                    <div class="p-6 md:w-2/3">
                        <h2 class="text-3xl font-bold mb-2"><?= $album['name'] ?? '' ?></h2>
                        <p class="text-lg mb-4">
                            <a href="<?= base_url('artist/' . $album['artist_id']) ?>"
                                    class="text-indigo-600 hover:underline"><?= $album['artist_name'] ?? '' ?></a>
                        </p>
                        <p class="text-gray-600 mb-6">Publicado el
                            <?= date('d/m/Y', strtotime($album['releasedate'] ?? 10)) ?>
                        </p>

                        <div class="bg-gray-50 p-4 rounded mb-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-xl font-semibold">Canciones</h3>
                            </div>

                            <div class="divide-y">
                                <?php if (!isset($tracks)) { ?>
                                    <div class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4 text-center">
                                        <p class="text-gray-500">No se encontraron tracks.</p>
                                    </div>
                                <?php } else { ?>
                                    <?php foreach ($tracks as $index => $track): ?>
                                        <div class="flex items-center py-3 px-2 hover:bg-gray-100 group">
                                            <div class="w-8 text-center text-gray-500"><?= $index + 1 ?></div>
                                            <div class="flex-grow px-4">
                                                <p class="font-medium"><?= $track['name'] ?></p>
                                                <p class="text-sm text-gray-500"><?= $album['artist_name'] ?></p>
                                            </div>
                                            <div class="text-gray-500"><?= gmdate("i:s",$track['duration']) ?></div>
                                            <div class="ml-4 opacity-0 group-hover:opacity-100 transition">
                                                <button class="text-indigo-600 hover:text-indigo-800">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
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