<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class urunkategori extends Model
{
    protected $table='urunkategoris';
    protected $fillable=['name','users_id'];

      public function urunaltkategori()
    {
    	return $this->hasMany('App\models\urunaltkategori');
    }

	public function urun()
	{
    	return $this->hasManyThrough('App\models\urun', 'App\models\urunaltkategori');	
	}
}

