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
Route::get('/peliculas', 'PeliculasController@getListIni');

Route::get('/peliculas/{id}', 'PeliculasController@peliculaId');

Route::post('/peliculas', 'PeliculasController@create');

Route::put('/peliculas/{id}', 'PeliculasController@put');

Route::delete('peliculas/{id}', 'PeliculasController@remove');

//Personas
Route::get('/personas', 'PersonasController@getListIni');

Route::get('/personas/{id}', 'PersonasController@show');

Route::post('/personas', 'PersonasController@store');

Route::put('/personas/{id}', 'PersonasController@update');

Route::delete('personas/{id}', 'PersonasController@destroy');


//Noticias

Route::get('/noticias', 'NoticiasController@getListIni');

Route::get('/noticias/{id}', 'NoticiasController@show');

Route::post('/noticias', 'NoticiasController@store');

Route::put('/noticias/{id}', 'NoticiasController@update');

Route::delete('noticias/{id}', 'NoticiasController@destroy');

//Criticas
Route::get('/criticas', 'CriticasController@getListIni');

Route::get('/criticas/{id}', 'CriticasController@show');

Route::post('/criticas', 'CriticasController@store');

Route::put('/criticas/{id}', 'CriticasController@update');

Route::delete('criticas/{id}', 'CriticasController@destroy');

//Usuarios

Route::get('/users2', 'Users2Controller@getListIni');

Route::get('/users2/{id}', 'Users2Controller@peliculaId');

Route::post('/users2', 'Users2Controller@create');

Route::put('/users2/{id}', 'Users2Controller@put');

Route::delete('users2/{id}', 'Users2Controller@remove');


//Recursos Personalizados
Route::get('/customResource/estrenos', 'CustomRequests@getEstrenos');

Route::get('/customResource/criticas', 'CustomRequests@getPromedioCriticas');

Route::get('/customResource/animes', 'CustomRequests@getAnimesporEstreno');

Route::get('/customResource/{id}/usuarios', 'CustomRequests@getCriticasPelicula');

Route::get('/customResource/noticias', 'CustomRequests@getNoticiasFecha');

Route::get('/customResource/{id}/criticaPelicula', 'CustomRequests@getCriticasPromedioPelicula');

Route::get('/customResource/{idMovie}/{idUser}/criticaUsuarioPelicula', 'CustomRequests@getCriticasUsuarioPelicula');

Route::get('/customResource/estrenosDirector', 'CustomRequests@getEstrenosDirector');

Route::get('/customResource/{id}/peliculasDirector', 'CustomRequests@getEstrenosDirectorID');

Route::get('/customResource/{id}/peliculaInformacion', 'CustomRequests@getPeliculaDirectorPromedio');

Route::get('/customResource/{word}/buscarNoticia', 'CustomRequests@getBuscarNoticias');

Route::get('/customResource/{word}/buscarPelicula', 'CustomRequests@getBuscarPeliculas');

Route::get('/customResource/{sub}/obtenerUsuario', 'CustomRequests@getUsersporEmail');
