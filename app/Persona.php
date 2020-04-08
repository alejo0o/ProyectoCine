<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table='personas';
    protected $fillable = ['perid','paiid','pernombre','perapellido','perfechanacim','perlugarnacim'];
    protected $primaryKey = 'perid';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps=false;
}
