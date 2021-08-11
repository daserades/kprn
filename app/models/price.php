<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class price extends Model
{
    protected $table='prices';
    protected $fillable=['urun_id','price','price2','users_id'];

    public function urun ()
    {
    	return $this->belongsTo('App\models\urun','urun_id','id');
    } 
}
