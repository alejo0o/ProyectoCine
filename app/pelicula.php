<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pelicula extends Model
{

    protected $table='peliculas';
    protected $fillable = ['id','nombre','fechadelanzamiento','duracion','clasificacion','sinopsis','trailer','paisdeorigen'];
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
}
