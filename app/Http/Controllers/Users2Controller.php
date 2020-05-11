<?php

namespace App\Http\Controllers;

use App\users2;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Users2Controller extends Controller
{
    public function list()
    {
        return json_encode(users2::all());
    }

    public function create(Request $request)
    {
        $request->validate([
            'id' => 'numeric|min:1|max:999999999',
            'nickname' => 'required|min:1|max:100',
            'name' => 'required|min:1|max:100',
            'picture' => 'required|min:1|max:200',
            'email' => 'required|min:1|max:100',
            'sub' => 'required|min:1|max:255',
        ]);

        $pelicula = users2::create($request->all());
        return json_encode($pelicula);
    }


    public function peliculaId($id)
    {
        return json_encode(users2::findOrFail($id));
    }


    public function put(Request $request, $id)
    {
        $request->validate([
            'id' => 'numeric|min:1|max:999999999',
            'nickname' => 'required|min:1|max:100',
            'name' => 'required|min:1|max:100',
            'picture' => 'required|min:1|max:200',
            'email' => 'required|min:1|max:100',
            'sub' => 'required|min:1|max:255',
        ]);
        $pelicula = users2::findOrFail($id);
        $pelicula->nickname = $request->get('nickname');
        $pelicula->name = $request->get('name');
        $pelicula->picture = $request->get('picture');
        $pelicula->email = $request->get('email');
        $pelicula->sub = $request->get('sub');

        $pelicula->save();

        return $pelicula;
    }

    public function remove($id)
    {
        users2::findOrFail($id)->delete();
        return http_response_code(200);
    }
    public function getListIni()
    {
        $count = DB::table('users2')->paginate(3);

        $info = ["count" => $count->total(), "pages" => $count->lastPage(), "next" => $count->nextPageUrl(), "prev" => $count->previousPageUrl()];
        $results = $count->items();
        $paginador = ["info" => $info, "results" => $results];

        return json_encode($paginador);
    }
}
