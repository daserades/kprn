<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class store extends Model
{
     protected $table='stores';
    protected $fillable=['urun_id','miktar','aciklama','users_id'];

    public function urun ()
    {
    	return $this->belongsTo('App\models\urun');
    } 
}
