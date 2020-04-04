<?php

namespace App\Http\Controllers;

use App\pelicula;
use Illuminate\Http\Request;
use PHPUnit\Util\Json;

class PeliculasController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return json_encode(pelicula::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pelicula = pelicula::findOrFail($id)->delete();
        return http_response_code(200);
    }

    public function all()
    {
        return json_encode(pelicula::all());
    }
}
