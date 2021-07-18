<?php

use App\Http\Controllers\EpisodiosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeriesController;


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

Route::get('/serie', [SeriesController::class, 'listarSeries']);

Route::get('/serie/create', [SeriesController::class, 'create']);
Route::post('/serie/create', [SeriesController::class, 'store']);
Route::delete('/serie/delete/{id_serie}', [SeriesController::class, 'delete']);
Route::get('/serie/{id_serie}/infos', [SeriesController::class, 'infoSerie']);

Route::put('/episodio/update/{id_episodio}/assistido', [EpisodiosController::class, 'alteraEstadoAssistido']);