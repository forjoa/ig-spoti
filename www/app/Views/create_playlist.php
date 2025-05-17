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
            <div class="max-w-md mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-6 text-center">Crear Nueva Playlist</h2>

                    <form action="<?= base_url('create-playlist') ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-6">
                            <label for="playlist_name" class="block text-gray-700 font-medium mb-2">Nombre de la
                                Playlist *</label>
                            <input type="text" id="playlist_name" name="name" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                placeholder="Mi nueva playlist">
                        </div>

                        <div class="mb-8">
                            <label for="playlist_cover" class="block text-gray-700 font-medium mb-2">Imagen de Portada
                                (opcional)</label>

                            <div class="flex items-center justify-center w-full">
                                <label for="playlist_cover"
                                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mb-4 text-gray-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Haz clic para
                                                subir</p>
                                        <p class="text-xs text-gray-500">SVG, PNG, JPG o GIF (Máx. 2MB)</p>
                                    </div>
                                    <input id="playlist_cover" name="cover" type="file" class="hidden"
                                        accept="image/*" />
                                </label>
                            </div>
                            <div id="file_name" class="mt-2 text-sm text-gray-500 text-center"></div>
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="<?= base_url('my-playlists') ?>"
                                class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition">Cancelar</a>
                            <button type="submit"
                                class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">Crear
                                Playlist</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>

        <footer class="bg-gray-800 text-white py-4 mt-auto">
            <div class="container mx-auto px-4 text-center">
                <p>&copy; 2025 Music App. Todos los derechos reservados.</p>
            </div>
        </footer>
    </div>

    <script>
        // Mostrar nombre del archivo seleccionado
        document.getElementById('playlist_cover').addEventListener('change', function (e) {
            const fileName = e.target.files[0]?.name;
            document.getElementById('file_name').textContent = fileName || '';
        });
    </script>
</body>

</html>