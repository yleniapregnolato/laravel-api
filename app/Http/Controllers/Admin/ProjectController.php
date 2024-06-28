<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        $project = new Project();
        $project->fill($data);
        $project->slug = Str::slug($project->title);
        $project->save();

        $projects = Project::all();

        // aggiungo le tecnologie selezionate
        if ($request->has('technologies')) {
            $project->technologies()->attach($request->technologies);
        }

        return view('admin.projects.index', ['success'=> 'Progetto inserito', 'projects'=>$projects]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->validated();
        $project->slug = Str::slug($request->title);
        $project->update($data);

        $project->technologies()->sync($request->technologies);

        return redirect()->route('admin.projects.show', ['project'=> $project->slug])->with('message', ' project ' . $project->title . ' è stato modificato con successo');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->technologies()->detach();

        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', 'project ' . $project->title . ' è stato cancellato con successo');
    }
}
