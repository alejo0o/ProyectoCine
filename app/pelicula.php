<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pelicula extends Model
{

    protected $table = 'peliculas';
    protected $fillable = ['peliculasid', 'claid', 'nombre', 'fechadelanzamiento', 'duracion', 'sinopsis', 'trailer', 'portada'];
    protected $primaryKey = 'peliculasid';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
}
