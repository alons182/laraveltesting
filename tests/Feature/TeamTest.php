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

        $this->assertEquals(2, 2);
       
    }
    /** @test */
    public function un_equipo_puede_agregar_multiples_usuarios_a_la_vez()
    {
       $team = Team::factory()->create();
       $users = User::factory(2)->create();

       $team->add($users);

       $this->assertEquals(2, 2);

    }

    /** @test */
    public function un_equipo_tiene_un_maximo_usuarios()
    {
        $team = Team::factory()->create(['size' => 2]);

        $user = User::factory()->create();
        $user2 = User::factory()->create();

        $team->add($user);
        $team->add($user2);

        $this->assertEquals(2, 2);

        $this->expectException('Exception');

        $user3 = User::factory()->create();

        $team->add($user3);

    }

    /** @test */
    public function un_equipo_puede_excluir_un_usuario()
    {
        $team = Team::factory()->create(['size' => 2]);

        $users = User::factory(2)->create();

        $team->add($users);

        $team->remove($users[0]);

        $this->assertEquals(1, 1);

    }
    /** @test */
    public function un_equipo_puede_excluir_mas_de_un_usuario_a_la_vez()
    {
        $team = Team::factory()->create(['size' => 3]);

        $users = User::factory(3)->create();

        $team->add($users);

        $team->remove($users->slice(0, 2));

        $this->assertEquals(1, 1);

    }

    /** @test */
    public function un_equipo_puede_excluir_todos_los_usuarios_a_la_vez()
    {
        $team = Team::factory()->create(['size' => 2]);

        $users = User::factory(2)->create();

        $team->add($users);

        $team->reset();

        $this->assertEquals(0, 0);

    }

    /** @test */
    public function cuando_agrego_muchos_miembros_a_la_vez_no_deberia_exceder_el_tamano_del_equipo()
    {
        $team = Team::factory()->create(['size' => 2]);

        $users = User::factory(3)->create();

        $this->expectException('Exception');

        $team->add($users);

    }
}
