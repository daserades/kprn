<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class firmadetay extends Model
{
    protected $table='firmadetays';
    protected $fillable =['firma_id','vade','iskonta','kur_id','limit','users_id'];

    public function firma ()
    {
    	return $this->belongsTo('App\models\firma','firma_id','id');
    } 
    public function kur ()
    {
    	return $this->belongsTo('App\models\kur','kur_id','id');
    } 
}
