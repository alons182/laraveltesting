<?php

namespace Tests\Unit;

use App\Models\Team;
use PHPUnit\Framework\TestCase;

class TeamTest extends TestCase
{
    /** @test */
    public function un_equipo_tiene_nombre()
    {
        $team = new Team(['name' => 'Equipo 1']);

        $this->assertEquals('Equipo 1', $team->name);
    }
}
