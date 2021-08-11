<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class orderstatus extends Model
{
     protected $table = 'orderstatuses';
    protected $fillable = ['name']; 
}
