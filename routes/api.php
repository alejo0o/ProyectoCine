<?php

use App\pelicula;
use App\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Peliculas
Route::get('/peliculas', 'PeliculasController@all');

Route::get('/peliculas/{id}', 'PeliculasController@show');

Route::post('/peliculas', 'PeliculasController@store');

Route::put('/peliculas/{id}', 'PeliculasController@update');

Route::delete('peliculas/{id}', 'PeliculasController@destroy');

//Personas
Route::get('/personas', 'PersonasController@all');

Route::get('/personas/{id}', 'PersonasController@show');

Route::post('/personas', 'PersonasController@store');

Route::put('/personas/{id}', 'PersonasController@update');

Route::delete('personas/{id}', 'PersonasController@destroy');

//Noticias

Route::get('/noticias', 'NoticiasController@all');

Route::get('/noticias/{id}', 'NoticiasControlle@show');

Route::post('/noticias', 'NoticiasControlle@store');

Route::put('/noticias/{id}', 'NoticiasControlle@update');

Route::delete('noticias/{id}', 'NoticiasControlle@destroy');
