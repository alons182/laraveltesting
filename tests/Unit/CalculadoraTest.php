<?php

namespace Tests\Unit;

use App\Models\Calculadora;
use PHPUnit\Framework\TestCase;

class CalculadoraTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $cal = new Calculadora();
        $resultado = $cal->sumar(1,2);
        
        $this->assertEquals(3, $resultado);
    }
}
