<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class shipping extends Model
{
    protected $table= 'shippings';
    protected $fillable= ['ship_id','order_id','urun_id','barcode','users_id'];
    public function urun ()
    {
    	return $this->belongsTo(urun::class);
    }
    public function order ()
    {
    	return $this->belongsTo(order::class);
    }
    public function ship ()
    {
        return $this->belongsTo(ship::class);
    }
}
