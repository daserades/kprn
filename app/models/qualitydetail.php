<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class qualitydetail extends Model
{
	protected $table='qualitydetails';
    protected $fillable=['quality_id','qualitytype_id','urun_id','amount','unit_id','explanation','price','sum','users_id'];
    
    public function urun ()
    {
        return $this->belongsTo(urun::class);
    }
    public function unit ()
    {
        return $this->belongsTo(unit::class);
    }
    public function qualitytype ()
    {
        return $this->belongsTo(qualitytype::class);
    }
}
