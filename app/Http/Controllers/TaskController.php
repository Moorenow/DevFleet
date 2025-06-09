<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->validated());

        return ResponseHelper::created(
            'La tarea se ha creado correctamente',
            ['task' => $task]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $taskList = Task::where('project_id', $id)->get();

        if ($taskList->isEmpty()) {
            return ResponseHelper::notFound('No hay tareas para este proyecto');
        }

        return ResponseHelper::ok(
            'Esta es la lista de tareas',
            ['tasks' => $taskList]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);

        $task->update([
            'title' => $request->title,
            'due_date' => $request->due_date,
        ]);

        return ResponseHelper::ok(
            'El proyecto se ha actualizado correctamente',
            ['project' => $task]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return ResponseHelper::ok(
            'El proyecto se ha eliminado correctamente'
        );
    }
}
