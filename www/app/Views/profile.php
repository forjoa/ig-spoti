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
                    <a href="<?= base_url('profile') ?>" class="hover:text-indigo-200 font-bold">Mi Perfil</a>
                    <a href="<?= base_url('logout') ?>"
                        class="bg-indigo-700 px-4 py-2 rounded-md hover:bg-indigo-800">Cerrar Sesión</a>
                </div>
            </div>
        </header>

        <div class="container mx-auto px-4 py-8">
            <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-8">
                <h2 class="text-2xl font-bold mb-6">Mi Perfil</h2>

                <div class="mb-6 flex flex-col sm:flex-row items-center">
                    <div class="w-32 h-32 rounded-full overflow-hidden mb-4 sm:mb-0 sm:mr-6">
                        <img src="<?= $user['profile_pic'] != '' ? base_url('uploads/'.$user['profile_pic']) : base_url('unknown-artist.png') ?>" alt="Foto de perfil"
                            class="w-full h-full object-cover">
                    </div>

                    <div>
                        <h3 class="text-xl font-bold"><?= isset($user['username']) ? $user['username'] : '' ?></h3>
                        <p class="text-gray-600"><?= isset($user['email']) ? $user['email'] : '' ?></p>
                    </div>
                </div>

                <?php if (isset($success_message)): ?>
                    <div class="mb-6 p-3 bg-green-100 text-green-700 rounded-md">
                        <p><?= $success_message ?></p>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('profile/update') ?>" method="POST" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label for="username" class="block text-gray-700 mb-2">Nombre de usuario</label>
                        <input type="text" id="username" name="username" value="<?= isset($user['username']) ? $user['username'] : '' ?>"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <?php if (isset($username_error)): ?>
                            <p class="text-red-500 text-sm mt-1"><?= $username_error ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 mb-2">Correo electrónico (no se puede
                            cambiar)</label>
                        <input type="email" id="email" value="<?= isset($user['email']) ? $user['email'] : '' ?>" disabled
                            class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100">
                    </div>

                    <div class="mb-4">
                        <label for="age" class="block text-gray-700 mb-2">Edad</label>
                        <input type="number" id="age" name="age" value="<?= isset($user['age']) ? $user['age'] : '' ?>"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <?php if (isset($age_error)): ?>
                            <p class="text-red-500 text-sm mt-1"><?= $age_error ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="mb-4">
                        <label for="profile_picture" class="block text-gray-700 mb-2">Cambiar foto de perfil</label>
                        <input type="file" id="profile_picture" name="profile_picture" accept="image/*"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <?php if (isset($profile_picture_error)): ?>
                            <p class="text-red-500 text-sm mt-1"><?= $profile_picture_error ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="mb-4">
                        <label for="current_password" class="block text-gray-700 mb-2">Contraseña actual (necesaria para
                            cambiar contraseña)</label>
                        <input type="password" id="current_password" name="current_password"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <?php if (isset($current_password_error)): ?>
                            <p class="text-red-500 text-sm mt-1"><?= $current_password_error ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="mb-4">
                        <label for="new_password" class="block text-gray-700 mb-2">Nueva contraseña</label>
                        <input type="password" id="new_password" name="new_password"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <?php if (isset($new_password_error)): ?>
                            <p class="text-red-500 text-sm mt-1"><?= $new_password_error ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="mb-6">
                        <label for="repeat_password" class="block text-gray-700 mb-2">Repetir nueva contraseña</label>
                        <input type="password" id="repeat_password" name="repeat_password"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <?php if (isset($repeat_password_error)): ?>
                            <p class="text-red-500 text-sm mt-1"><?= $repeat_password_error ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="flex justify-between">
                        <button type="submit"
                            class="bg-indigo-600 text-white py-2 px-6 rounded-md hover:bg-indigo-700 transition">
                            Guardar cambios
                        </button>

                        <button type="button" onclick="confirmDeleteAccount()"
                            class="bg-red-600 text-white py-2 px-6 rounded-md hover:bg-red-700 transition">
                            Eliminar cuenta
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <footer class="bg-gray-800 text-white py-4 mt-auto">
            <div class="container mx-auto px-4 text-center">
                <p>&copy; 2025 Music App. Todos los derechos reservados.</p>
            </div>
        </footer>
    </div>

    <div id="delete-account-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-lg p-6 max-w-md w-full">
            <h3 class="text-xl font-bold mb-4">¿Estás seguro?</h3>

            <p class="mb-6">Esta acción eliminará permanentemente tu cuenta y todas tus playlists. Esta acción no se
                puede deshacer.</p>

            <div class="flex justify-end space-x-4">
                <button onclick="closeDeleteAccountModal()"
                    class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-100">
                    Cancelar
                </button>

                <form action="<?= base_url('profile/delete') ?>" method="POST">
                    <input type="hidden" name="user_id" value="<?= isset($user['id']) ? $user['id'] : '' ?>">
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                        Eliminar mi cuenta
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function confirmDeleteAccount() {
            document.getElementById('delete-account-modal').classList.remove('hidden');
            document.getElementById('delete-account-modal').classList.add('flex');
        }

        function closeDeleteAccountModal() {
            document.getElementById('delete-account-modal').classList.remove('flex');
            document.getElementById('delete-account-modal').classList.add('hidden');
        }
    </script>
</body>

</html>