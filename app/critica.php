<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class critica extends Model
{
    protected $table='criticas';
    protected $fillable = ['criid','peliculasid','id','critexto','crifecha','crivalor'];
    protected $primaryKey = 'criid';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps=false;
}
