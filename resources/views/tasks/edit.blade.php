<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar tarea: ' . $task->title) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="js-messages" class="mb-4"></div>

            <div class="bg-white shadow-md rounded p-6 max-w-lg mx-auto space-y-6">

                <!-- Formulario de edición -->
                <form id="taskForm" method="POST" action="{{ route('tasks.update', $task) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-1" for="title">Título</label>
                        <input type="text" name="title" value="{{ old('title', $task->title) }}"
                            placeholder="Título" maxlength="255"
                            class="border rounded px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-1" for="description">Descripción</label>
                        <textarea name="description" placeholder="Descripción" maxlength="1000"
                            class="border rounded px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $task->description) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-1" for="due_date">Fecha de
                            vencimiento</label>
                        <input type="date" name="due_date" value="{{ old('due_date', $task->due_date) }}"
                            class="border rounded px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-1" for="status">Estado</label>
                        <select name="status" required
                            class="border rounded px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="pending" @if ($task->status == 'pending') selected @endif>Pendiente</option>
                            <option value="completed" @if ($task->status == 'completed') selected @endif>Completada
                            </option>
                        </select>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded shadow transition">
                            Actualizar
                        </button>
                    </div>
                </form>

                <hr class="my-4">

                <!-- Formulario para compartir la tarea -->
                <div class="relative overflow-visible z-10">
                    <form method="POST" action="{{ route('tasks.share', $task) }}">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-gray-700 font-semibold mb-1" for="email">
                                Selecciona un usuario para compartir la tarea
                            </label>
                            <select name="user_id" id="user_id" required
                                class="border rounded px-3 py-2 w-full max-w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">-- Selecciona un usuario --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>

                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white font-semibold px-6 py-2 rounded shadow transition">
                                Compartir
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
