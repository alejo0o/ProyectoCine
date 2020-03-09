@extends('layouts.base')

@section('content')
    <div class="col">
        <h1>Borrar Pelicula {{$pelicula->id}}</h1>
    </div>
    <div class="row">
        <div class="col">
            <a class="btn btn-secondary" href="/peliculas">Back</a>
        </div>
    </div>
        <div class="row">
            <div class="col">
                <form action="/peliculas/{{$pelicula->id}}" method="POST">
                    @csrf
                    @method('delete')                   
                    <button type="submit" class="btn btn-primary">Eliminar</button>
                
                </form>
            </div>
        </div>
        
    
@endsection
