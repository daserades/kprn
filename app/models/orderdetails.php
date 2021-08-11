<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class orderdetails extends Model
{
    protected $table='orderdetails';
    protected $fillable=['order_id','urun_id','miktar','kalan','listefiyat','fiyat','kur_id','bazkur','tutar','bakiye','users_id'];

    public function order ()
    {
    	return $this->belongsTo('App\models\order','order_id','id');
    }
    public function urun ()
    {
    	return $this->belongsTo('App\models\urun');
    }
    
    public function kur ()
    {
        return $this->belongsTo('App\models\kur');
    } 	 
}
