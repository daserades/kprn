<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class urun extends Model
{
    protected $table = 'uruns';
    protected $fillable = ['name','no','barkod','urunaltkategori_id','ebat_id','models_id','urunozellik1_id','urunozellik2_id','urunozellik3_id','urunozellik4_id','urunozellik5_id','unit_id','paketiciadet','koliiciadet','ambalajtur_id','paketiciozellik_id','renk1_id','renk2_id','renk3_id','renk4_id','renk5_id','renk6_id','hacim','gramaj','asgaristok','ipliktur','icerik','aciklama','ticarikod','ticariad','tmad','tmkod','urunturu_id','durum_id','users_id'];

   /* public function category()
    {
        return $this->belongsToMany(category::class, 'categories_urun');
    }*/
    public function shipping()
    {
        return $this->hasMany('App\models\shipping');
    }
    public function botdetail()
    {
        return $this->hasMany(botdetail::class);
    }
    public function urunaltkategori()
    {
    	return $this->belongsTo('App\models\urunaltkategori');
    }
    public function models()
    {
        return $this->belongsTo('App\models\models','models_id','id');
    }
    public function ebat()
    {
    	return $this->belongsTo('App\models\ebat');
    }
    public function urunozellik1()
    {
    	return $this->belongsTo('App\models\urunozellik','urunozellik1_id','id');
    }
    public function urunozellik2()
    {
    	return $this->belongsTo('App\models\urunozellik','urunozellik2_id','id');
    }
    public function urunozellik3()
    {
    	return $this->belongsTo('App\models\urunozellik','urunozellik3_id','id');
    }
    public function urunozellik4()
    {
    	return $this->belongsTo('App\models\urunozellik','urunozellik4_id','id');
    }
    public function urunozellik5()
    {
    	return $this->belongsTo('App\models\urunozellik','urunozellik5_id','id');
    }
    public function unit()
    {
    	return $this->belongsTo('App\models\unit');
    }
    public function ambalajtur()
    {
    	return $this->belongsTo('App\models\ambalajtur');
    }
    public function paketiciozellik()
    {
    	return $this->belongsTo('App\models\paketiciozellik');
    }
    public function renk1()
    {
    	return $this->belongsTo('App\models\renk','renk1_id','id');
    }
    public function renk2()
    {
    	return $this->belongsTo('App\models\renk','renk2_id','id');
    }
    public function renk3()
    {
    	return $this->belongsTo('App\models\renk','renk3_id','id');
    }
    public function renk4()
    {
    	return $this->belongsTo('App\models\renk','renk4_id','id');
    }
    public function renk5()
    {
    	return $this->belongsTo('App\models\renk','renk5_id','id');
    }
    public function renk6()
    {
    	return $this->belongsTo('App\models\renk','renk6_id','id');
    }
    public function urunturu()
    {
    	return $this->belongsTo('App\models\urunturu');
    }
    public function durum()
    {
    	return $this->belongsTo('App\models\durum');
    }
    public function price ()
    {
        return $this->belongsTo('App\models\price','id','urun_id');
    }
    public function store ()
    {
        return $this->hasOne('App\models\store');
    }
    public function storedetail()
    {
        return $this->hasMany(storedetail::class);
    }
     

}
