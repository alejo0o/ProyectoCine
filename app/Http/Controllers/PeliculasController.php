<?php

namespace App\Http\Controllers;

use App\pelicula;
use Illuminate\Http\Request;

class PeliculasController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('peliculas.index', [
            'peliculas' => pelicula::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('peliculas.create');
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
        pelicula::create($request->all());
        return redirect('/peliculas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (isset($id)) {
            return pelicula::where('id', $id)->get();
        } elseif (!isset($id)) {
            return pelicula::all();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('peliculas.edit', [
            'pelicula' => pelicula::findOrFail($id),
        ]);
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

        return redirect('/peliculas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        pelicula::findOrFail($id)->delete();
        return redirect('/peliculas');
    }

    public function all()
    {
        return pelicula::all();
    }
}
