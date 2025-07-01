<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-xl p-10 flex flex-col items-center text-center">
                <h1 class="text-3xl font-bold text-gray-800 mb-4">Bienvenido al Gestor de Tareas Colaborativas 🚀</h1>
                <p class="text-gray-600 mb-6 max-w-xl">
                    Organiza tus tareas, compártelas con otros usuarios y trabaja de forma más eficiente.
                </p>
                <a href="{{ route('tasks.index') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-lg shadow-lg transition transform hover:scale-105">
                    Ir al panel de tareas
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
