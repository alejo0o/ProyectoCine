<?php

namespace App\Http\Controllers;

use App\pelicula;
use Illuminate\Http\Request;

class PeliculasApi extends Controller
{

    public function list()
    {
        return json_encode(pelicula::all());
    }

    public function create(Request $request)
    {
        $rules_save = [
            'expresion' => ['required', 'regex:/^(AA|A|B|C|D)?$/i'],
        ];
        $request->validate([
            'id' => 'numeric|min:1|max:999999999',
            'nombre' => 'required|min:1|max:50',
            'fechadelanzamiento' => 'date',
            'duracion' => 'numeric|min:1|max:2147483647',
            'clasificacion' => $rules_save['expresion'],
            'sinopsis' => 'required',
            'trailer' => 'url',
            'paisdeorigen' => 'required|min:1|max:30',
        ]);

        $pelicula = pelicula::create($request->all());
        return json_encode($pelicula);
    }


    public function peliculaId($id)
    {
        return json_encode(pelicula::findOrFail($id));
    }


    public function put(Request $request, $id)
    {
        $rules_save = [
            'expresion' => ['required', 'regex:/^(AA|A|B|C|D)?$/i'],
        ];
        $request->validate([
            'id' => 'numeric|min:1|max:999999999',
            'nombre' => 'required|min:1|max:50',
            'fechadelanzamiento' => 'date',
            'duracion' => 'numeric|min:1|max:2147483647',
            'clasificacion' => $rules_save['expresion'],
            'sinopsis' => 'required',
            'trailer' => 'url',
            'paisdeorigen' => 'required|min:1|max:30',
        ]);
        $pelicula = pelicula::findOrFail($id);
        $pelicula->nombre = $request->get('nombre');
        $pelicula->fechadelanzamiento = $request->get('fechadelanzamiento');
        $pelicula->duracion = $request->get('duracion');
        $pelicula->clasificacion = $request->get('clasificacion');
        $pelicula->sinopsis = $request->get('sinopsis');
        $pelicula->trailer = $request->get('trailer');
        $pelicula->paisdeorigen = $request->get('paisdeorigen');

        $pelicula->save();

        return $pelicula;
    }

    public function remove($id)
    {
        pelicula::findOrFail($id)->delete();
        return http_response_code(200);
    }
}
