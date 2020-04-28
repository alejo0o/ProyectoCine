<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomRequests extends Controller
{
    public function getEstrenos()
    {
        $count = DB::table('peliculas')->select('*')->orderBy('fechadelanzamiento', 'desc')->paginate(3);
        $info = ["count" => $count->total(), "pages" => $count->lastPage(), "next" => $count->nextPageUrl(), "prev" => $count->previousPageUrl()];
        $results = $count->items();
        $paginador = ["info" => $info, "results" => $results];
        return json_encode($paginador);
        /*$count = DB::table('peliculas')->selectRaw('peliculasid,fechadelanzamiento as fechita')->orderByRaw('fechadelanzamiento')->get();
        echo $count;*/
    }
    public function getPromedioCriticas()
    {
        $count = DB::table('peliculas')
            ->join('criticas', 'peliculas.peliculasid', '=', 'criticas.peliculasid')
            ->selectRaw('avg(crivalor) as promedio,peliculas.peliculasid ,peliculas.nombre,peliculas.sinopsis,peliculas.fechadelanzamiento
,peliculas.duracion, peliculas.portada')
            //->whereRaw('criticas.peliculasid = peliculas.peliculasid')
            ->groupByRaw('peliculas.peliculasid ')
            ->orderByRaw('promedio desc')
            ->paginate(1);

        $info = ["count" => $count->total(), "pages" => $count->lastPage(), "next" => $count->nextPageUrl(), "prev" => $count->previousPageUrl()];
        $results = $count->items();
        $paginador = ["info" => $info, "results" => $results];
        return json_encode($paginador);
    }
}
