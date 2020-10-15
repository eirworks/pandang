<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = auth()->user()->projects()
            ->latest('updated_at')
            ->withCount(['monitors'])
            ->paginate();

        return view('projects.index', [
            'projects' => $projects,
        ]);
    }

    public function show(Project $project)
    {
        $monitors = $project->monitors()
            ->paginate();

        $monitors = $monitors->setCollection($monitors->getCollection()->each(function($monitor) {
            $monitor->pings = $monitor->pings()
                ->limit(60)
                ->latest('id')
                ->get();
        }));

        return view('projects.show', [
            'project' => $project,
            'monitors' => $monitors,
        ]);
    }

    public function edit(Project $project)
    {
        return view('projects.form', [
            'project' => $project,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $project = new Project($request->only(['name', 'description']));
        $project->image = "";
        $project->user_id = auth()->id();
        $project->save();

        return redirect()->route('projects::index');
    }

    public function update(Request $request, Project $project)
    {
        $project->fill($request->only(['name', 'description']));
        $project->save();

        return redirect()->route('projects::index');
    }
}
