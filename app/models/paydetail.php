<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class paydetail extends Model
{
    protected $table='paydetails';
    protected $fillable=['type_id','pay_id','payloadtype_id','miktar','kur_id','banka','asilkisi','vadetrh','evrakno','users_id'];

    public function pay()
    {
        return $this->belongsTo(pay::class);
    }
    public function ship()
    {
        return $this->belongsTo(ship::class);
    }
    public function type()
    {
        return $this->belongsTo(type::class);
    }
    public function kur()
    {
        return $this->belongsTo(kur::class);
    }
    public function payloadtype()
    {
        return $this->belongsTo(payloadtype::class);
    }
}
