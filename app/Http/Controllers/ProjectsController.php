<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function show(Project $project)
    {
        return view('projects.show', [
            'project' => $project
        ]);
    }

    public function store()
    {
  
        $data = request()->all();

        Project::create([
            ...$data,
            'user_id' => auth()->user()->id
        ]);
    }
}
