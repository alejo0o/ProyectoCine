<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $table = 'noticias';
    protected $fillable = ['notid', 'peliculasid', 'nottexto', 'notfecha'];
    protected $primaryKey = 'notid';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
}
