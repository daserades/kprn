<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class pay extends Model
{
    protected $table='pays';
    protected $fillable=['no','firma_id','trh','aciklama','tutar','kur_id','users_id'];

    public function paydetail()
    {
        return $this->hasMany(paydetail::class);
    }
    public function firma()
    {
        return $this->belongsTo(firma::class);
    }
    public function kur()
    {
        return $this->belongsTo(kur::class);
    }
    public function cari()
    {
        return $this->belongsTo(cari::class);
    }
}
