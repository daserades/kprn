<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ebat extends Model
{
    protected $table='ebats';
    protected $fillable=['name','en','boy','yukseklik','hacim','users_id'];
}
