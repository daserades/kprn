<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $table='orders';
    protected $fillable=['firma_id','sevktrh','firmadetay_id','orderstatuses_id','iskonta','vade','no','bazkur','kur_id','koliadet','sevkadres','aciklama','users_id'];
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
    public function orderdetails()
    {
        return $this->hasMany(orderdetails::class);
    }
    public function orderstatus()
    {
        return $this->belongsTo('App\models\orderstatus','orderstatuses_id','id');
    }
    public function shipping()
    {
        return $this->hasMany(shipping::class);
    }
    public function irsaliye()
    {
        return $this->hasOne(irsaliye::class);
    }
    public function irsaliyedetails()
    {
        return $this->hasMany(irsaliyedetails::class);
    }
    public function ship()
    {
        return $this->hasMany(ship::class);
    }

}
