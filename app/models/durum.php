<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class durum extends Model
{
    protected $table = 'durums';
    protected $fillable = ['name','surname'];
}
