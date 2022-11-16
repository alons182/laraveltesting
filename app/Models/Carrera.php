<?php
namespace App\Models;


class Carrera{
    public int $cod;
    public string $name;
    public $cursos = [];

    public function __construct(int $codigo, string $nombre) {
        $this->cod = $codigo;
        $this->name = $nombre;
    }

    public function asignarCurso(Curso $curso)
    {
        $this->cursos[] = $curso;
    }

}
