<?php

namespace Tests\Unit;

use App\Models\Carrera;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * @test
     */
    public function probar_arreglo()
    {
        $arreglo = [1,2,3];

        $this->assertCount(3, $arreglo);
        $this->assertEquals([1,2,3], $arreglo);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_carrera()
    {
        $carrera = new Carrera(1, 'info');

        $this->assertEquals('Info', $carrera->name);
    }

}
