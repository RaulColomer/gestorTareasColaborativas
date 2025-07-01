<div id="own-tasks-container" class="mb-8">
    @include('tasks.partials.table', ['tasks' => $ownTasks, 'isShared' => false])
</div>

<div>
    <h2 class="font-semibold text-lg mb-2">Tareas compartidas conmigo</h2>
    @include('tasks.partials.table', ['tasks' => $sharedTasks, 'isShared' => true])
</div>
