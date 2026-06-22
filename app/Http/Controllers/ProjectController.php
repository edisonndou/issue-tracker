<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Auth::user()->projects()->latest()->get();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(StoreProjectRequest $request)
    {
        $project = Auth::user()->projects()->create($request->validated());
        return redirect()->route('projects.show', $project)->with('success', 'Project created!');
    }

    public function show(Project $project)
    {
        $issues = $project->issues()->with('tags', 'assignees', 'comments')->latest()->get();
        $tags = \App\Models\Tag::all();
        return view('projects.show', compact('project', 'issues', 'tags'));
    }

    public function edit(Project $project)
    {
        if (Auth::user()->id !== $project->user_id) {
            abort(403);
        }
        return view('projects.edit', compact('project'));
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        if (Auth::user()->id !== $project->user_id) {
            abort(403);
        }
        $project->update($request->validated());
        return redirect()->route('projects.show', $project)->with('success', 'Project updated!');
    }

    public function destroy(Project $project)
    {
        if (Auth::user()->id !== $project->user_id) {
            abort(403);
        }
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted!');
    }
}

