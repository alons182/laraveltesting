<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function show(Project $project)
    {
        $user = Use::first();
        auth()->login($user);

       $this->authorize('view', $project);

        return view('projects.show', [
            'project' => $project
        ]);
    }

    public function store()
    {
  
        $data = request()->all();

        $data = $this->validate(request(), [
            'name' => ['required', 'unique:projects']
        ]);

        Project::create([
            ...$data,
            'user_id' => auth()->user()->id
        ]);
    }
}
