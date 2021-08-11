<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class cari extends Model
{
   protected $table='caris';
    protected $fillable=['firma_id','trh','vadetrh','ship_id','quality_id','pay_id','paydetail_id','order_id','tutar','alinantutar','kur_id','aciklama','users_id'];

    public function firma ()
    {
        return $this->belongsTo(firma::class);
    }
    public function order ()
    {
        return $this->belongsTo(order::class);
    }
    public function kur ()
    {
        return $this->belongsTo(kur::class);
    }
    public function ship ()
    {
        return $this->belongsTo(ship::class);
    }
    public function pay ()
    {
        return $this->hasOne('App\models\pay','id','pay_id');
    }
}
