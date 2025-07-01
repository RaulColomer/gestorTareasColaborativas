<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ver tarea: ' . $task->title) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded p-6 max-w-lg mx-auto space-y-6">

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Título</label>
                    <p class="border rounded px-3 py-2 bg-gray-100">{{ $task->title }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Descripción</label>
                    <p class="border rounded px-3 py-2 bg-gray-100 whitespace-pre-line">{{ $task->description }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Fecha de vencimiento</label>
                    <p class="border rounded px-3 py-2 bg-gray-100">{{ $task->due_date_formatted }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Estado</label>
                    <span
                        class="inline-block min-w-[100px] text-center text-xs font-semibold rounded-full px-2 py-1
                        {{ $task->status === 'completed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                        {{ ucfirst($task->status_label ?? $task->status) }}
                    </span>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Propietario</label>
                    <p class="border rounded px-3 py-2 bg-gray-100">{{ $task->owner->name }} ({{ $task->owner->email }})
                    </p>
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('tasks.index') }}"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded shadow transition">
                        Volver
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
