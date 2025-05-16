<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music App - Iniciar Sesión</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <header class="bg-indigo-600 text-white p-4">
            <div class="container mx-auto">
                <h1 class="text-3xl font-bold">Music App</h1>
            </div>
        </header>

        <main class="flex-grow flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-md p-8 max-w-md w-full">
                <h2 class="text-2xl font-bold mb-6 text-center">Iniciar Sesión</h2>
                
                <form action="<?= base_url('sign-in') ?>" method="POST">
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 mb-2">Correo electrónico</label>
                        <input type="email" id="email" name="email" required value="<?= isset($email) ? $email : '' ?>"
                            class="w-full px-3 py-2 border <?= isset($email_error) ? 'border-red-500' : 'border-gray-300' ?> rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <?php if (isset($email_error)): ?>
                            <p class="text-red-500 text-sm mt-1"><?= $email_error ?></p>
                        <?php endif; ?>
                    </div>
                    
                    <div class="mb-6">
                        <label for="password" class="block text-gray-700 mb-2">Contraseña</label>
                        <input type="password" id="password" name="password" required
                            class="w-full px-3 py-2 border <?= isset($password_error) ? 'border-red-500' : 'border-gray-300' ?> rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <?php if (isset($password_error)): ?>
                            <p class="text-red-500 text-sm mt-1"><?= $password_error ?></p>
                        <?php endif; ?>
                    </div>
                    
                    <?php if (isset($login_error)): ?>
                        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-md">
                            <p><?= $login_error ?></p>
                        </div>
                    <?php endif; ?>
                    
                    <div class="flex flex-col gap-4">
                        <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition">
                            Iniciar Sesión
                        </button>
                        
                        <div class="text-center">
                            <p class="text-gray-600">¿No tienes una cuenta? <a href="<?= base_url('sign-up') ?>" class="text-indigo-600 hover:underline">Regístrate</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </main>

        <footer class="bg-gray-800 text-white py-4">
            <div class="container mx-auto px-4 text-center">
                <p>&copy; 2025 Music App. Todos los derechos reservados.</p>
            </div>
        </footer>
    </div>
</body>
</html>