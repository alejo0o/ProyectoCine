<?php

namespace App\Http\Controllers;

use App\critica;
use Illuminate\Http\Request;

class criticasController extends Controller
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
            'valorcritica' => ['required', 'regex:/[0-9]{1,3}[,.]{0,1}[0-9]{0,2}/u']
        ];
        $request->validate([
            'criid' => 'numeric|min:1|max:999999999',
            'peliculasid' => 'numeric|min:1|max:999999999',
            'id' => 'numeric|min:1|max:999999999',
            'critexto' => $rules_save['expresion'],
            'crifecha' => 'date',
            'crivalor' => $rules_save['valorcritica'],
        ]);
        
        $critica = critica::create($request->all());
        return json_encode($critica);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return json_encode(critica::findOrFail($id));
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
            'valorcritica' => ['required', 'regex:/[0-9]{1,3}[,.]{0,1}[0-9]{0,2}/u']
        ];
        $request->validate([
            'criid' => 'numeric|min:1|max:999999999',
            'peliculasid' => 'numeric|min:1|max:999999999',
            'id' => 'numeric|min:1|max:999999999',
            'critexto' => $rules_save['expresion'],
            'crifecha' => 'date',
            'crivalor' => $rules_save['valorcritica'],
        ]);
        $critica = critica::findOrFail($id);
        $critica->peliculasid = $request->get('peliculasid');
        $critica->id = $request->get('id');
        $critica->critexto = $request->get('critexto');
        $critica->crifecha = $request->get('crifecha');
        $critica->crivalor = $request->get('crivalor');
        $critica->save();

        return $critica;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $critica = critica::findOrFail($id)->delete();
        return http_response_code(200);
    }

    public function all()
    {
        return json_encode(critica::all());
    }
}
