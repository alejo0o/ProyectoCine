<?php

use App\pelicula;
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

Route::get('/peliculas', 'PeliculasApi@list');

Route::get('/peliculas/{id}', 'PeliculasApi@peliculaId');

Route::post('/peliculas', 'PeliculasApi@create');

Route::put('/peliculas/{id}', 'PeliculasApi@put');

Route::delete('peliculas/{id}', 'PeliculasApi@remove');
