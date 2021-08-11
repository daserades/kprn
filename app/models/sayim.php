<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class sayim extends Model
{
    protected $table='sayims';
    protected $fillable=['urun_id','miktar'];

    public function urun()
    {
    	return $this->hasOne('App\models\urun','id','urun_id');
    }
}
