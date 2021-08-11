<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class storedetail extends Model
{
     protected $table='storedetails';
    protected $fillable=['urun_id','no','sayim','users_id'];

    public function urun ()
    {
    	return $this->belongsTo('App\models\urun','urun_id','id');
    }
    public function inputoutput ()
    {
    	return $this->belongsTo('App\models\inputoutput');
    }  
}
