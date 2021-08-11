<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class categories_urun extends Model
{
    protected $table='categories_uruns';
    protected $fillable=['category_id','urun_id'];

}
