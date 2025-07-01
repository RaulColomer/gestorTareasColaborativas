<div id="own-tasks-container" class="mb-8">
    @include('tasks.partials.table', ['tasks' => $ownTasks, 'isShared' => false])
</div>

<div>
    <h3 class="font-semibold text-lg mb-2">Tareas compartidas conmigo</h3>
    @include('tasks.partials.table', ['tasks' => $sharedTasks, 'isShared' => true])
</div>
