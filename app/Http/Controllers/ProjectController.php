<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        return ResponseHelper::ok(
            'Esta es la lista de proyectos',
            ['projects' => Project::where('user_id', auth()->id())->get()]
        );
    }

    public function store(StoreProjectRequest $request)
    {
        $project = Project::create($request->validated());

        return ResponseHelper::created(
            'El proyecto se ha creado correctamente',
            ['project' => $project]
        );
    }

    public function update(UpdateProjectRequest $request, $id)
    {
        $project = Project::findOrFail($id);

        $project->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return ResponseHelper::ok(
            'El proyecto se ha actualizado correctamente',
            ['project' => $project]
        );
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return ResponseHelper::ok(
            'El proyecto se ha eliminado correctamente'
        );
    }
}
