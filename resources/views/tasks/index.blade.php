<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis tareas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('components.flash-messages')
            <div id="js-messages" class="mb-4"></div>
            <form method="GET" action="{{ route('tasks.index') }}" class="mb-4 flex flex-wrap items-center gap-2">
                <select name="status" class="border rounded px-3 py-2 w-64">
                    <option value="">-- Todos los estados --</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pendiente</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completada
                    </option>
                </select>

                <select name="order" class="border rounded px-3 py-2 w-72">
                    <option value="asc" {{ request('order') === 'asc' ? 'selected' : '' }}>Fecha vencimiento
                        ascendente</option>
                    <option value="desc" {{ request('order') === 'desc' ? 'selected' : '' }}>Fecha vencimiento
                        descendente</option>
                </select>

                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Aplicar
                </button>
            </form>

            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-6">
                <div class="flex justify-between items-center mb-4">
                    <a href="{{ route('tasks.create') }}"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold px-4 py-2 rounded shadow inline-block">
                        + Nueva tarea
                    </a>
                </div>
                <div id="tasks-wrapper" class="relative">
                    <div id="tables-container">
                        @include('tasks.partials.tables', compact('ownTasks', 'sharedTasks'))
                    </div>

                    <div id="tasks-loading"
                        class="hidden absolute inset-0 bg-white bg-opacity-75 flex flex-col justify-center items-center z-10">
                        <span
                            class="inline-block w-6 h-6 border-4 border-blue-500 border-t-transparent rounded-full animate-spin"></span>
                        <p class="text-sm text-gray-500 mt-2">Actualizando tareas...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
