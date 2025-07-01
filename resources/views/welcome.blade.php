<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido | Mi To-Do App</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-br from-blue-50 via-white to-blue-100 min-h-screen flex items-center justify-center">

    <div class="bg-white rounded-xl shadow-2xl w-full max-w-xl grid grid-cols-1 sm:grid-cols-2 overflow-hidden">

        <!-- Lado izquierdo: imagen o icono -->
        <div class="bg-blue-600 text-white flex flex-col justify-center items-center p-8">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mb-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m1-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h2 class="text-xl font-bold">Tu gestor de tareas colaborativas</h2>
        </div>

        <!-- Lado derecho: acciones -->
        <div class="p-8 flex flex-col justify-center">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Bienvenido</h1>
            <p class="text-sm text-gray-500 mb-6">Accede o crea una cuenta para empezar a gestionar tus tareas.</p>

            <a href="{{ route('login') }}"
                class="w-full inline-block text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg mb-3 shadow transition">
                Iniciar sesión
            </a>
            <a href="{{ route('register') }}"
                class="w-full inline-block text-center border border-gray-300 hover:border-gray-400 text-gray-700 font-semibold py-3 rounded-lg shadow transition">
                Registrarse
            </a>
        </div>

    </div>

</body>

</html>
