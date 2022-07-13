<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_un_proyecto_tiene_path()
    {
        $project = Project::factory()->create();


        $this->assertEquals($project->path(), '/projects/'. $project->id);
    }

     /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_un_proyecto_tiene_creador()
    {
        $project = Project::factory()->create();


        $this->assertInstanceOf(User::class, $project->creator);
    }
}
