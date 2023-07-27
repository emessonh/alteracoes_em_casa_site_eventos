<?php

use Illuminate\Support\Facades\Route;

/* Importa a classe EventController */
use App\Http\Controllers\EventController;

/* Define as rotas e qual action chamar
    ['Classe', 'Nome de action']
*/
Route::get('/', [EventController::class, 'index']);
Route::get('/events/create', [EventController::class, 'create'])->middleware('auth');
Route::post('/events', [EventController::class, 'store']);
Route::get('/events/{id}', [EventController::class, 'show']);
Route::get('/dashboard', [EventController::class, 'dashboard'])->middleware('auth');
/** Utilizando name no front para chamar a action, atrvés de name('nome Atribuído') */
Route::delete('/events/destroy/{id}', [EventController::class, 'destroy'])->middleware('auth')->name('deleteEvents');
Route::get('/events/edit/{id}', [EventController::class, 'edit'])->middleware('auth')->name('editEvent');
Route::put('/events/update/{id}', [EventController::class, 'update'])->middleware('auth');
Route::get('/events/join/{id}', [EventController::class, 'joinEvent'])->middleware('auth');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Testando Blade - Aulas iniciais
Route::get('/', function () {
    $nome = 'pedro';
    $idade = 29;

    $array = [1,2,3,4,5];
    $nomes = ['emesson', 'rafael', 'milena', 'natalia'];
    return view('Aulas_iniciais/welcome',
    ['nome' => $nome,
    'idade' => $idade,
    'array' => $array,
    'nomes' => $nomes]);
});

Route::get('/contatos', function () {
    return view('Aulas_iniciais/contatos');
});

Route::get('/produtos', function () {
    return view('Aulas_iniciais/produtos');
});
/* Utilizando parâmetro opcional, com 'null' como padrão */
/*Route::get('/avaliacao/{id?}', function ($id = null) {
    return view('Aulas_iniciais/avaliacao', [ 'id' => $id]);
});

/*  Utilizando parâmentro obrigatório
    Route::get('/avaliacao/{id}', function ($id) {
    return view('avaliacao', [ 'id' => $id]);
}); */

/* Utilizando query para passar parâmetros
    ex: /busca?search=camisa
*/
/* Route::get('/busca', function () {
    $busca = request('search');
    return view('Aulas_iniciais/busca', [ 'busca' => $busca]);
}); */





