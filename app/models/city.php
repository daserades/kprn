<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class city extends Model
{
    protected $table='cities';
    protected $fillable =['name','countries_id'];
}
