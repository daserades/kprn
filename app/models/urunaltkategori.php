<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class urunaltkategori extends Model
{
	protected $table='urunaltkategoris';
	protected $fillable=['name','urunkategori_id','users_id'];

	public function urunkategori()
	{
		return $this->belongsTo('App\models\urunkategori');
	}
    public function urun()
    {
        return $this->belongsToMany(Urun::class, 'categories_uruns','category_id','urun_id')->where('durum_id',1)->orderby('no')->groupby('no','name');
    }
}
