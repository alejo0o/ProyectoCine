<?php

namespace App\Http\Controllers;

use App\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoticiasController extends Controller
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
            'expresion' => ['required', 'regex:/^[\pL\s\-]+$/u'],
        ];
        $request->validate([
            'notid' => 'numeric|min:1|max:999999999',
            'peliculasid' => 'numeric|min:1|max:999999999',
            'nottexto' => 'required',
            'notfecha' => 'date',
            'nottitulo' => 'required',
            'notimagen' => 'url',
        ]);
        $noticia = Noticia::create($request->all());
        return json_encode($noticia);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return json_encode(Noticia::findOrFail($id));
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
            'expresion' => ['required', 'regex:/^[\pL\s\-]+$/u'],
        ];
        $request->validate([
            'peliculasid'=>'numeric|min:1|max:999999999',
            'nottexto' => 'required',
            'notfecha' => 'date',
            'nottitulo' => 'required',
            'notimagen' => 'url',
        ]);
        $noticia = Noticia::findOrFail($id);
        $noticia->peliculasid = $request->get('peliculasid');
        $noticia->nottexto = $request->get('nottexto');
        $noticia->notfecha = $request->get('notfecha');
        $noticia->nottitulo = $request->get('nottitulo');
        $noticia->notimagen = $request->get('notimagen');
        $noticia->save();

        return $noticia;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $noticia = Noticia::findOrFail($id)->delete();
        return http_response_code(200);
    }

    public function all()
    {
        return json_encode(Noticia::all());
    }
}
