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
    public function un_equipo_puede_agregar_usuario()
    {
        $team = Team::factory()->create();
        $user = User::factory()->create();
        $user2 = User::factory()->create();

        $team->add($user);
        $team->add($user2);

        $this->assertEquals(2, $team->count());
       
    }
    /** @test */
    public function un_equipo_puede_agregar_multiples_usuarios_a_la_vez()
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
    public function un_equipo_puede_excluir_un_usuario()
    {
        $team = Team::factory()->create(['size' => 3]);
        $users = User::factory(3)->create();
        $team->add($users);
        $this->assertEquals(3, $team->count());
        
        $user = User::get()->first();
        $team->excluirUsuario($user);
        $user = User::get();
        $this->assertEquals(3, $user->count());

    }

    /** @test */
    public function un_equipo_puede_excluir_todos_los_usuarios_a_la_vez()
    {
        $team = Team::factory()->create(['size' => 3]);
        $user = User::factory(3)->create();
        $team->add($user);
        $this->assertEquals(3, $team->count());
        
        $team->excluirTodosLosUsuarios();
        $this->assertEquals(0,$team->count());
       
        $user = User::get();
        $this->assertEquals(3, $user->count());
    }
}
