<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class gorevlistesi extends Model
{
    protected $table='gorevlistesis';
    protected $fillable=['name','departman_id'];
    public function departman () 
    {
    	return $this->belongsTo('App\models\departman','departman_id','id');
    }
}
