<?php

namespace App\Http\Controllers;

use App\Persona;
use Illuminate\Foundation\Bootstrap\SetRequestForConsole;
use Illuminate\Http\Request;
use Symfony\Component\Console\Event\ConsoleErrorEvent;

class PersonasController extends Controller
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
            'perid' => 'numeric|min:1|max:999999999',
            'paiid' => 'numeric|min:1|max:999999999',
            'pernombre' => $rules_save['expresion'],
            'perapellido' => $rules_save['expresion'],
            'perfechanacim' => 'date',
            'perlugarnacim' => $rules_save['expresion'],
        ]);
        $persona = Persona::create($request->all());
        return json_encode($persona);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return json_encode(Persona::findOrFail($id));
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
            'perid' => 'numeric|min:1|max:999999999',
            'paiid' => 'numeric|min:1|max:999999999',
            'pernombre' => $rules_save['expresion'],
            'perapellido' => $rules_save['expresion'],
            'perfechanacim' => 'date',
            'perlugarnacim' => $rules_save['expresion'],
        ]);
        $persona = Persona::findOrFail($id);
        $persona->paiid = $request->get('paiid');
        $persona->pernombre = $request->get('pernombre');
        $persona->perapellido = $request->get('perapellido');
        $persona->perfechanacim = $request->get('perfechanacim');
        $persona->perlugarnacim = $request->get('perlugarnacim');

        $persona->save();

        return $persona;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $persona = Persona::findOrFail($id)->delete();
        return http_response_code(200);
    }

    public function all()
    {
        return json_encode(Persona::all());
    }
}
