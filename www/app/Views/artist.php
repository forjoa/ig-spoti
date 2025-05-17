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
                        <img src="<?= $artist['image'] == '' ? base_url('unknown-artist.png') : $artist['image'] ?>"
                            alt="<?= $artist['name'] ?? '' ?>"
                            class="w-full h-auto object-cover pl-4 pt-4 pr-4 rounded-md">
                    </div>
                    <div class="p-6 md:w-2/3">
                        <h2 class="text-3xl font-bold mb-2"><?= $artist['name'] ?? '' ?></h2>
                        <p class="text-gray-600 mb-4">Se unió el
                            <?= date('d/m/Y', strtotime($artist['joindate'] ?? 10)) ?>
                        </p>

                        <h3 class="text-xl font-semibold mb-4 mt-6 border-b pb-2">Álbumes</h3>
                        <?php if (!isset($albums)) { ?>
                            <div class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4 text-center">
                                <p class="text-gray-500">No se encontraron álbumes.</p>
                            </div>
                        <?php } else { ?>
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                <?php foreach ($albums as $album): ?>
                                    <a href="<?= base_url('album/' . $album['id']) ?>" class="group">
                                        <div
                                            class="bg-gray-100 rounded overflow-hidden shadow transition transform group-hover:scale-105">
                                            <img src="<?= !$album['image'] || $album['image'] == '' ? base_url('unknown-music.jpg') : $album['image'] ?>"
                                                alt="<?= $album['name'] ?>" class="w-full h-40 object-cover">
                                            <div class="p-3">
                                                <h4 class="font-semibold truncate"><?= $album['name'] ?></h4>
                                                <p class="text-sm text-gray-500">
                                                    <?= date('Y', strtotime($album['releasedate'])) ?>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php } ?>
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