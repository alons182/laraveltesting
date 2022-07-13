<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_puedo_ver_un_proyecto()
    {
        $project = Project::factory()->create();

        $response = $this->get($project->path());

        $response->assertStatus(200)
                ->assertSee($project->name);
    }

    public function test_puedo_ver_crear_proyecto()
    {
        $data = [
            'name' => 'Projecto 1'
        ];

        $user = User::factory()->create();
        
       $this->be($user);

        $response = $this->post('/projects', $data);

        $this->assertDatabaseHas('projects',[
            'name' => 'Projecto 1'
        ]);
    }
}
