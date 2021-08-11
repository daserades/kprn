<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class yetkili extends Model
{
    protected $table= 'yetkilis';
    protected $fillable= ['name','surname','firma_id','gorevlistesi_id','tel','ceptel','email','aciklama','users_id'];
	public function firma ()
    {
    	return $this->belongsTo('App\models\firma','firma_id','id');
    }
    public function gorevlistesi ()
    {
    	return $this->belongsTo('App\models\gorevlistesi','gorevlistesi_id','id');
    }
}
