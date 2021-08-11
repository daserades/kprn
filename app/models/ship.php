<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ship extends Model
{
   protected $table='ships';
   protected $fillable=['order_id','firma_id','orderstatus_id','irsaliyeno','koliadet','users_id'];
   public function order()
    {
    	return $this->belongsTo(order::class);
    }
    public function firma()
    {
    	return $this->belongsTo(firma::class);
    }
    public function shipping ()
    {
        return $this->hasMany(shipping::class);
    }
    public function orderstatus()
    {
      return $this->belongsTo(orderstatus::class);
    }
    public function cari ()
    {
      return $this->hasOne(cari::class);
    }
}
