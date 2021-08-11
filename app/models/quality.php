<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class quality extends Model
{
    protected $table='qualities';
    protected $fillable=['firma_id','sevktrh','firmadetay_id','iskonta','vade','bazkur','kur_id','dispatchno','explanation','users_id'];

    public function firma ()
    {
    	return $this->belongsTo('App\models\firma','firma_id','id');
    } 
     public function firmadetay ()
    {
    	return $this->belongsTo('App\models\firmadetay','firmadetay_id','id');
    }
    public function kur ()
    {
    	return $this->belongsTo('App\models\kur');
    }
    public function qualitytype ()
    {
        return $this->belongsTo('App\models\qualitytype');
    }
    public function qualitydetail ()
    {
        return $this->hasMany('App\models\qualitydetail');
    }
}
