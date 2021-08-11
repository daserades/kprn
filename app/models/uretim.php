<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class uretim extends Model
{
    protected $table='uretims';
    protected $fillable=['no','urun_id','users_id'];

    public function urun()
    {
    	return $this->belongsTo('App\models\urun');
    }
}
