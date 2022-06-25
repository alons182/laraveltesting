<?php

namespace Tests\Feature;

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeamTest extends TestCase
{
    use RefreshDatabase;
    
    
    /** @test */
    public function El_equipo_puede_agregar_un_usuario()
    {
        $team = Team::factory()->create();
        $user = User::factory()->create();
        $user2 = User::factory()->create();

        $team->add($user);
        $team->add($user2);

        $this->assertEquals(2, $team->count());
       
    }
    /** @test */
    public function El_equipo_puede_agregar_multiples_usuarios()
    {
       $team = Team::factory()->create();
       $users = User::factory(2)->create();

       $team->add($users);

       $this->assertEquals(2, $team->count());

    }

    /** @test */
    public function un_equipo_tiene_un_maximo_usuarios()
    {
        $team = Team::factory()->create(['size' => 2]);

        $user = User::factory()->create();
        $user2 = User::factory()->create();

        $team->add($user);
        $team->add($user2);

        $this->assertEquals(2, $team->count());

        $this->expectException('Exception');

        $user3 = User::factory()->create();

        $team->add($user3);

    }

    /** @test */
    public function El_equipo_puede_desasociar_a_un_usuario()
    {
        # code...
        $team = Team::factory()->create();

        $user = User::factory(5)->create();

        $team->add($user);

        $this->assertEquals(5, $team->count());

        $user = User::get()->first();

        $team->dissociate_members($user);

        $user = User::get();

        $this->assertEquals(5, $user->count());
    }

    /** @test */
    public function El_equipo_puede_desasociar_todos_los_usuarios()
    {
        # code...
        $team = Team::factory()->create();

        $user = User::factory(5)->create();

        $team->add($user);

        $this->assertEquals(5, $team->count());

        $team->dissociate_members();

        $this->assertEquals(0, $team->count());

        $user = User::get();

        $this->assertEquals(5, $user->count());
    }

   
}
