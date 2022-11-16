<?php

use App\Http\Controllers\ProjectsController;
use App\Models\Project;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/projects/{project}', [ProjectsController::class, 'show']);
// Route::post('/projects', [ProjectsController::class, 'store']);

// class Carrera{
//     public int $cod;
//     public string $name;
//     public $cursos = [];

//     public function __construct(int $codigo, string $nombre) {
//         $this->cod = $codigo;
//         $this->name = $nombre;
//     }

//     public function asignarCurso(Curso $curso)
//     {
//         $this->cursos[] = $curso;
//     }

// }

// class Curso{
//     public string $sigla;
//     public string $name;
//     public Carrera $carrera;

//     public function __construct(string $sigla, string $nombre, Carrera $carrera) {
//         $this->sigla = $sigla;
//         $this->name = $nombre;
//         $this->carrera = $carrera;
        
      
//     }

// }
// $infocarrera = new Carrera(1, "Informatica");
// $analisis = new Curso("IF2222","Analisis y Diseño", $infocarrera);
// $infocarrera->asignarCurso($analisis);
// // dd($infocarrera, $analisis);