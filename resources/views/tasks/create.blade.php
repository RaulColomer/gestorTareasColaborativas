<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nueva tarea') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="js-messages" class="mb-4"></div>
            <form id="taskForm" method="POST" action="{{ route('tasks.store') }}"
                class="bg-white shadow-md rounded p-6 max-w-lg mx-auto">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1" for="title">Título</label>
                    <input type="text" name="title" placeholder="Título" class="border p-2 w-full mb-2">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1" for="description">Descripción</label>
                    <textarea name="description" placeholder="Descripción" class="border p-2 w-full mb-2"></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1" for="due_date">Fecha de
                        vencimiento</label>
                    <input type="date" name="due_date" class="border p-2 w-full mb-2">
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded shadow">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
