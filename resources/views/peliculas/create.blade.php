@extends('layouts.base')

@section('content')
    <div class="col">
        <h1>Nueva Pelicula</h1>
    </div>
    <div class="row">
        <div class="col">
            <a class="btn btn-secondary" href="/peliculas">Back</a>
        </div>
    </div>
        <div class="row">
            <div class="col">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>                  
                @endif
                <form action="/peliculas" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">ID:</label>
                        <input type="text" class="form-control" name="id" id="id" placeholder="ID" value="{{old('id')}}"> 
                        <label for="title">Nombre:</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="nombre" value="{{old('nombre')}}">
                        <label for="title">Fecha de Lanzamiento:</label>
                        <input type="text" class="form-control" name="fechadelanzamiento" id="fechadelanzamiento" placeholder="aaaa/mm/dd" value="{{old('fechadelanzamiento')}}">
                        <label for="title">Duracion:</label>
                        <input type="text" class="form-control" name="duracion" id="duracion" placeholder="Duración" value="{{old('duracion')}}">
                        <label for="title">Clasificación:</label>
                        <input type="text" class="form-control" name="clasificacion" id="clasificacion" placeholder="A" value="{{old('clasificacion')}}">
                        <label for="title">Sinopsis:</label>
                        <input type="text" class="form-control" name="sinopsis" id="sinopsis" placeholder="Sinopsis" value="{{old('sinopsis')}}">     
                        <label for="title">Trailer:</label>
                        <input type="text" class="form-control" name="trailer" id="trailer" placeholder="Trailer" value="{{old('trailer')}}"> 
                        <label for="title">Pais de Origen:</label>
                        <input type="text" class="form-control" name="paisdeorigen" id="paisdeorigen" placeholder="Pais de Origen" value="{{old('paisdeorigen')}}">             
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                
                </form>
            </div>
        </div>
        
    
@endsection

