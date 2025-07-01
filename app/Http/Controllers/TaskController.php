<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\TaskStatusRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $order = $request->get('order', 'asc');
        $status = $request->get('status');

        $ownTasksQuery = auth()->user()->tasks()->orderBy('due_date', $order);
        $sharedTasksQuery = auth()->user()->sharedTasks()->orderBy('due_date', $order);

        if ($status) {
            $ownTasksQuery->where('status', $status);
            $sharedTasksQuery->where('status', $status);
        }

        $ownTasks = $ownTasksQuery->get();
        $sharedTasks = $sharedTasksQuery->get();

        if ($request->ajax()) {
            return view('tasks.partials.tables', compact('ownTasks', 'sharedTasks'))->render();
        }

        return view('tasks.index', compact('ownTasks', 'sharedTasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $task = Task::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => 'pending',
        ]);

        if ($task) {
            return redirect()->route('tasks.index')->with('success', 'La tarea ha sido creada correctamente.');
        } else {
            return redirect()->back()->with('error', 'No se pudo crear la tarea. Intenta de nuevo.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $users = User::where('id', '!=', auth()->id())->get();

        return view('tasks.edit', compact('task', 'users'));
    }

    public function show(Task $task)
    {
        // Asegúrate que el usuario tiene permiso de verlo
        if (
            $task->owner->id !== auth()->id() &&
            !$task->sharedWith->contains(auth()->id())
        ) {
            abort(403);
        }

        return view('tasks.show', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'La tarea ha sido actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if ($task->sharedWith()->exists()) {
            return redirect()->route('tasks.index')->with('error', 'No puedes eliminar una tarea que está compartida con otros usuarios.');
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'La tarea ha sido eliminada correctamente.');
    }

    public function toggleStatus(TaskStatusRequest $request, Task $task)
    {
        $task->status = $task->status === 'pending' ? 'completed' : 'pending';
        $task->save();

        return response()->json(['success' => true, 'status' => $task->status, 'label' => $task->status_label]);
    }

    public function share(Request $request, Task $task)
    {
        // Verifica que el dueño es el que comparte
        if ($task->owner->id !== auth()->id()) {
            abort(403, 'No autorizado');
        }

        // Valida el user_id
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        // Comprueba si ya está compartida
        if ($task->sharedWith->contains($request->user_id)) {
            return redirect()
                ->route('tasks.index')
                ->with('error', 'La tarea ya estaba compartida con este usuario.');
        }

        // Asocia
        $task->sharedWith()->attach($request->user_id);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tarea compartida con éxito.');
    }
}
