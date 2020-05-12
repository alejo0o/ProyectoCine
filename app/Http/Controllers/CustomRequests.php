<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomRequests extends Controller
{
    public function getEstrenos()
    {
        $count = DB::table('peliculas')->select('*')->orderBy('fechadelanzamiento', 'desc')->paginate(10);
        $info = ["count" => $count->total(), "pages" => $count->lastPage(), "next" => $count->nextPageUrl(), "prev" => $count->previousPageUrl()];
        $results = $count->items();
        $paginador = ["info" => $info, "results" => $results];
        return json_encode($paginador);
    }
    public function getPromedioCriticas()
    {
        $count = DB::table('peliculas')
            ->join('criticas', 'peliculas.peliculasid', '=', 'criticas.peliculasid')
            ->join('clasificacion', 'peliculas.claid', '=', 'clasificacion.claid')
            ->selectRaw('avg(crivalor) as promedio,peliculas.peliculasid ,peliculas.nombre,peliculas.sinopsis,peliculas.fechadelanzamiento
,peliculas.duracion, peliculas.portada, clasificacion.clanombre')
            //->whereRaw('criticas.peliculasid = peliculas.peliculasid')
            ->groupByRaw('peliculas.peliculasid, clasificacion.clanombre ')
            ->orderByRaw('promedio desc')
            ->paginate(10);

        $info = ["count" => $count->total(), "pages" => $count->lastPage(), "next" => $count->nextPageUrl(), "prev" => $count->previousPageUrl()];
        $results = $count->items();
        $paginador = ["info" => $info, "results" => $results];
        return json_encode($paginador);
    }
    public function getAnimesporEstreno()
    {
        $count = DB::table('peliculas')
            ->join('tiene', 'peliculas.peliculasid', '=', 'tiene.peliculasid')
            ->selectRaw('peliculas.peliculasid,peliculas.nombre, peliculas.fechadelanzamiento,peliculas.duracion,peliculas.sinopsis,peliculas.portada')
            ->whereRaw('tiene.genid = 2')
            ->orderByRaw('fechadelanzamiento desc')
            ->paginate(10);
        $info = ["count" => $count->total(), "pages" => $count->lastPage(), "next" => $count->nextPageUrl(), "prev" => $count->previousPageUrl()];
        $results = $count->items();
        $paginador = ["info" => $info, "results" => $results];
        return json_encode($paginador);
    }
    public function getCriticasPelicula($id)
    {
        $count = DB::table('criticas')
            ->join('users', 'criticas.id', '=', 'users.id')
            ->select('criticas.crifecha', 'users.email', 'criticas.critexto', 'criticas.crivalor', 'criticas.criid')
            ->where('criticas.peliculasid', '=', $id)
            ->orderByRaw('criticas.crifecha desc')
            ->paginate(10);

        $info = ["count" => $count->total(), "pages" => $count->lastPage(), "next" => $count->nextPageUrl(), "prev" => $count->previousPageUrl()];
        $results = $count->items();
        $paginador = ["info" => $info, "results" => $results];

        return json_encode($paginador);
    }
    public function getNoticiasFecha()
    {
        $count = DB::table('noticias')->select('*')->orderBy('notfecha', 'desc')->paginate(10);
        $info = ["count" => $count->total(), "pages" => $count->lastPage(), "next" => $count->nextPageUrl(), "prev" => $count->previousPageUrl()];
        $results = $count->items();
        $paginador = ["info" => $info, "results" => $results];
        return json_encode($paginador);
    }
    public function getCriticasPromedioPelicula($id)
    {
        $count = DB::table('peliculas')
            ->join('criticas', 'peliculas.peliculasid', '=', 'criticas.peliculasid')
            ->join('clasificacion', 'peliculas.claid', '=', 'clasificacion.claid')
            ->selectRaw('avg(crivalor) as promedio,peliculas.peliculasid ,peliculas.nombre,peliculas.sinopsis,peliculas.fechadelanzamiento
,peliculas.duracion, peliculas.portada, clasificacion.clanombre')
            ->where('peliculas.peliculasid', '=', $id)
            ->groupByRaw('peliculas.peliculasid, clasificacion.clanombre ')
            ->orderByRaw('promedio desc')
            ->paginate(10);

        $info = ["count" => $count->total(), "pages" => $count->lastPage(), "next" => $count->nextPageUrl(), "prev" => $count->previousPageUrl()];
        $results = $count->items();
        $paginador = ["info" => $info, "results" => $results];
        return json_encode($paginador);
    }
    public function getCriticasUsuarioPelicula($idMovie, $idUser)
    {
        $count = DB::table('criticas')
            ->select('*')
            ->where('peliculasid', '=', $idMovie)
            ->where('id', '=', $idUser)
            ->paginate(10);
        $info = ["count" => $count->total(), "pages" => $count->lastPage(), "next" => $count->nextPageUrl(), "prev" => $count->previousPageUrl()];
        $results = $count->items();
        $paginador = ["info" => $info, "results" => $results];
        return json_encode($paginador);
    }
    public function getEstrenosDirector()
    {
        $count = DB::table('participa')
            ->join('peliculas', 'participa.peliculasid', '=', 'peliculas.peliculasid')
            ->join('personas', 'participa.perid', '=', 'personas.perid')
            ->join('roles', 'participa.rolid', '=', 'roles.rolid')
            ->selectRaw('peliculas.peliculasid, peliculas.nombre, peliculas.fechadelanzamiento, peliculas.duracion,peliculas.sinopsis,
            peliculas.trailer, peliculas.portada,personas.pernombre, personas.perapellido')
            ->where('roles.rolid', '=', '3')
            ->groupByRaw('peliculas.peliculasid, personas.pernombre, personas.perapellido')
            ->orderByRaw('peliculas.fechadelanzamiento desc')
            ->paginate(10);
        $info = ["count" => $count->total(), "pages" => $count->lastPage(), "next" => $count->nextPageUrl(), "prev" => $count->previousPageUrl()];
        $results = $count->items();
        $paginador = ["info" => $info, "results" => $results];
        return json_encode($paginador);
    }
    public function getEstrenosDirectorID($idMovie)
    {
        $count = DB::table('participa')
            ->join('peliculas', 'participa.peliculasid', '=', 'peliculas.peliculasid')
            ->join('personas', 'participa.perid', '=', 'personas.perid')
            ->join('roles', 'participa.rolid', '=', 'roles.rolid')
            ->selectRaw('peliculas.peliculasid, peliculas.nombre, peliculas.fechadelanzamiento, peliculas.duracion,peliculas.sinopsis,
            peliculas.trailer, peliculas.portada,personas.pernombre, personas.perapellido')
            ->where('roles.rolid', '=', '3')
            ->where('peliculas.peliculasid', '=', $idMovie);

        return json_encode($count->first());
    }
    public function getPeliculaDirectorPromedio($id)
    {
        $count = DB::table('peliculas')
            ->join('criticas', 'peliculas.peliculasid', '=', 'criticas.peliculasid')
            ->join('clasificacion', 'peliculas.claid', '=', 'clasificacion.claid')
            ->join('participa', 'peliculas.peliculasid', '=', 'participa.peliculasid')
            ->join('personas', 'participa.perid', '=', 'personas.perid')
            ->selectRaw('avg(crivalor) as promedio,peliculas.peliculasid ,peliculas.nombre,peliculas.sinopsis,peliculas.fechadelanzamiento
,peliculas.duracion, peliculas.portada, clasificacion.clanombre, personas.pernombre, personas.perapellido')
            ->where('peliculas.peliculasid', '=', $id)
            ->where('participa.rolid', '=', 3)
            ->groupByRaw('peliculas.peliculasid, clasificacion.clanombre, personas.pernombre, personas.perapellido');


        return json_encode($count->first());
    }
    public function getBuscarNoticias($palabra)
    {
        $count = DB::table('noticias')
            ->select('*')
            ->where(strtolower('nottitulo'), 'ILIKE', '%' . strtolower($palabra) . '%')
            -> orderByRaw('notfecha desc')
            ->paginate(6);
        $info = ["count" => $count->total(), "pages" => $count->lastPage(), "next" => $count->nextPageUrl(), "prev" => $count->previousPageUrl()];
        $results = $count->items();
        $paginador = ["info" => $info, "results" => $results];
        return json_encode($paginador);
    }
    public function getBuscarPeliculas($palabra)
    {
        $count = DB::table('peliculas')
            ->select('*')
            ->where(strtolower('nombre'), 'ILIKE', '%' . strtolower($palabra) . '%')
            -> orderByRaw('fechadelanzamiento desc')
            ->paginate(6);
        $info = ["count" => $count->total(), "pages" => $count->lastPage(), "next" => $count->nextPageUrl(), "prev" => $count->previousPageUrl()];
        $results = $count->items();
        $paginador = ["info" => $info, "results" => $results];
        return json_encode($paginador);
    }
    public function getUsersporEmail($sub)
    {
        $count = DB::table('users2')
            ->select('*')
            ->where('sub', '=', $sub);
        return json_encode($count->first());
    }
}
