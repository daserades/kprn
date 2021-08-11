<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class models extends Model
{
	 protected $table= 'models';
	 protected $fillable= ['name','users_id'];

/*
	public function urunaltkategori()
	{
		return  $this->belongsToMany('App\models\urunaltkategori', 'urunaltkategori_models', 'models_id', 'urunaltkategori_id');
	}
	 public function urun()
	 {
	 	return $this->belongsToMany('App\models\urun','models_uruns','models_id','urun_id')->where('durum_id',1);
	 }
	 */
	 public function urun()
    {
        return $this->hasMany('App\models\urun');
    }
}
