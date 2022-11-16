<?php

namespace Tests\Unit;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
class ContactTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        // $contacto = new Contact(['name' => 'ALONSo']);
        $contacto = new Contact();
        $contacto->name = 'alonso';
        $contacto->save();

        $this->assertEquals('ALONSO', $contacto->getNombreMayusculas());
        $this->assertDatabaseHas('contacts', ['name' => 'alonso']);
        
        


    }
}
