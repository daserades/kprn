<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class kgsevk extends Model
{
    protected $table = 'kgsevks';
    protected $fillable = ['urun_id','firma_id','unit_id','miktar','brutmiktar','fiyat','users_id'];

    public function firma()
    {
    	return $this->belongsTo(firma::class);
    }
    public function urun()
    {
    	return $this->belongsTo(urun::class);
    }
    public function unit()
    {
    	return $this->belongsTo(unit::class);
    }
}
