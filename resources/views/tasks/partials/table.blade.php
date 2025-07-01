<div class="w-full overflow-x-auto scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
    <table class="w-full table-auto border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2 text-left">Título</th>
                <th class="border px-4 py-2 text-left">Descripción</th>
                <th class="border px-4 py-2 text-left">Fecha vencimiento</th>
                @if ($isShared)
                    <th class="border px-4 py-2 text-left">Propietario</th>
                @endif
                <th class="border px-4 py-2 text-left">Estado</th>
                <th class="border px-4 py-2 text-left">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tasks as $task)
                <tr>
                    <td class="border px-4 py-2">{{ $task->title }}</td>
                    <td class="border px-4 py-2">{{ $task->description }}</td>
                    <td class="border px-4 py-2">{{ $task->due_date_formatted ?? $task->due_date }}</td>
                    @if ($isShared)
                        <td class="border px-4 py-2 text-sm text-gray-700">
                            {{ $task->owner->name }} <span
                                class="text-gray-400 text-xs">({{ $task->owner->email }})</span>
                        </td>
                    @endif
                    <td class="border px-4 py-2">
                        <span
                            class="inline-block min-w-[100px] text-center text-xs font-semibold rounded-full px-2 py-1
                    {{ $task->status === 'completed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ ucfirst($task->status_label ?? $task->status) }}
                        </span>
                    </td>
                    <td class="border px-4 py-2 flex items-center gap-2">
                        @if (!$isShared)
                            <!-- Tu toggle y acciones de owner -->
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only mark-completed peer mark-own-task"
                                    data-id="{{ $task->id }}" @if ($task->status === 'completed') checked @endif>
                                <div
                                    class="w-11 h-6 bg-gray-300 rounded-full transition-colors duration-300 peer-checked:bg-green-500">
                                    <div
                                        class="w-5 h-5 bg-white rounded-full shadow transform transition-transform duration-300 peer-checked:translate-x-5">
                                    </div>
                                </div>
                            </label>
                            <a href="{{ route('tasks.show', $task) }}"
                                class="text-gray-700 hover:underline text-sm">Ver</a>
                            <a href="{{ route('tasks.edit', $task) }}"
                                class="text-blue-600 hover:underline text-sm">Editar</a>
                            <button type="button" class="text-red-600 hover:underline text-sm"
                                onclick="openDeleteModal({{ $task->id }})">
                                Eliminar
                            </button>
                        @else
                            <!-- Toggle para compartidas -->
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only mark-completed peer mark-shared-task"
                                    data-id="{{ $task->id }}" @if ($task->status === 'completed') checked @endif>
                                <div
                                    class="w-11 h-6 bg-gray-300 rounded-full transition-colors duration-300 peer-checked:bg-green-500">
                                    <div
                                        class="w-5 h-5 bg-white rounded-full shadow transform transition-transform duration-300 peer-checked:translate-x-5">
                                    </div>
                                </div>
                            </label>
                            <a href="{{ route('tasks.show', $task) }}"
                                class="text-gray-700 hover:underline text-sm">Ver</a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ $isShared ? 6 : 5 }}" class="border px-4 py-6 text-center text-gray-500">No hay
                        tareas</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div id="delete-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full">
        <h2 class="text-lg font-bold mb-4">Confirmar eliminación</h2>
        <p class="text-gray-600 mb-6">¿Estás seguro de que deseas eliminar esta tarea? Esta acción no se puede deshacer.
        </p>
        <div class="flex justify-end gap-2">
            <button onclick="closeDeleteModal()" class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 text-gray-700">
                Cancelar
            </button>
            <form id="delete-task-form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 rounded bg-red-500 hover:bg-red-600 text-white">
                    Eliminar
                </button>
            </form>
        </div>
    </div>
</div>
