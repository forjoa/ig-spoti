<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music App - Bienvenido</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <header class="bg-indigo-600 text-white p-4">
            <div class="container mx-auto">
                <h1 class="text-3xl font-bold">Music App</h1>
            </div>
        </header>

        <main class="flex-grow">
            <div class="container mx-auto py-16 px-4">
                <div class="max-w-3xl mx-auto text-center">
                    <h2 class="text-4xl font-bold mb-6">Tu música, en cualquier momento y lugar</h2>
                    <p class="text-xl mb-8">Descubre nuevos artistas, crea playlists personalizadas y disfruta de millones de canciones.</p>
                    
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="<?= base_url('sign-in') ?>" class="bg-indigo-600 text-white px-6 py-3 rounded-md font-medium hover:bg-indigo-700 transition">Iniciar Sesión</a>
                        <a href="<?= base_url('sign-up') ?>" class="bg-white text-indigo-600 border border-indigo-600 px-6 py-3 rounded-md font-medium hover:bg-gray-50 transition">Registrarse</a>
                    </div>
                </div>

                <div class="mt-16 grid md:grid-cols-3 gap-8">
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="text-indigo-600 text-4xl mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Millones de canciones</h3>
                        <p class="text-gray-600">Accede a un amplio catálogo musical con artistas de todo el mundo.</p>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="text-indigo-600 text-4xl mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Crea tus playlists</h3>
                        <p class="text-gray-600">Organiza tus canciones favoritas en listas personalizadas.</p>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="text-indigo-600 text-4xl mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Descubre nuevos artistas</h3>
                        <p class="text-gray-600">Encuentra música nueva basada en tus gustos e intereses.</p>
                    </div>
                </div>
            </div>
        </main>

        <footer class="bg-gray-800 text-white py-6">
            <div class="container mx-auto px-4 text-center">
                <p>&copy; 2025 Music App. Todos los derechos reservados.</p>
            </div>
        </footer>
    </div>
</body>
</html>