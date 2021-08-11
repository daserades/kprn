<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class current extends Model
{
    protected $table='currents';
    protected $fillable=['pay_id','paydetail_id','order_id','quality_id','ship_id','firma_id','vadetrh','debt','paid','kur_id','durum_id','close_id','open_id','option','users_id'];

    public function firma()
    {
    	return $this->belongsTo(firma::class);
    }
    public function order()
    {
    	return $this->belongsTo(order::class);
    }
    public function ship()
    {
    	return $this->belongsTo(ship::class);
    }
    public function pay()
    {
    	return $this->belongsTo(pay::class);
    }
    public function paydetail()
    {
        return $this->hasOne('App\models\paydetail','id','paydetail_id');
    }
    public function kur()
    {
    	return $this->belongsTo(kur::class);
    }
    public function durum()
    {
    	return $this->belongsTo(durum::class);
    }
}
