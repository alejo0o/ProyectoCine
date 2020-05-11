<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class users2 extends Model
{
    protected $table = 'users2';
    protected $fillable = ['id', 'nickname', 'name', 'picture', 'email', 'sub', 'email_verified_at', 'remember_token'];
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
}
