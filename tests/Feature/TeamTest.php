<?php

namespace Tests\Feature;

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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

        //$team->delete($team[1]);

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
        //creamos el team y los user
        $team = Team::factory()->create();

        $user = User::factory()->create();
        $user2 = User::factory()->create();
        //$team->unset($team[1]);
        $team->add($user);
        $team->add($user2);
        //agregamos los user al team

        //eliminamos los users
        $team->unsetUser($user2);
        $this->assertEquals(1, $team->count());
    }



    /** @test */
    public function un_equipo_puede_excluir_todos_los_usuarios_a_la_vez()
    {
        //creamos el team y los user
        $team = Team::factory()->create();

        $user = User::factory()->create();
        $user2 = User::factory()->create();
        //$team->delete($team[1]);
        $team->add($user);
        $team->add($user2);

        //eliminamos los users
        $team->unsetAllUsers($user2, $user);

        $this->assertEquals(0, $team->count());

    }


//  /** @test */
//     public function un_equipo_puede_excluir_todos_los_usuarios_a_la_vez()
//     {
//         //creamos el team y los user
//         $team = Team::factory()->create();

//         $user = User::factory()->create();
//         $user2 = User::factory()->create();
//         //$team->delete($team[1]);
//         $team->add($user);
//         $team->add($user2);

//         //eliminamos los users

//         $this->assertEquals(0,  $team-> unsetAllUsers($user2, $user));

//     }



}
