<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class firma extends Model
{
    protected $table='firmas';
    protected $fillable=['name','firmatipi_id','firma_limit','personel_id','unvan','vergidairesi','verginumarasi','tel1','tel2','fax1','fax2','email1','email2','adres1','adres2','countries_id','cities_id','banka','sube','hesapno','iban','website','durums_id','nakliye1_id','nakliye2_id','ticarikod','faturatipi_id','aciklama','kur_id','users_id'];
    
    public function order ()
    {
        return $this->hasMany(order::class);
    }
    public function cari ()
    {
        return $this->hasMany(cari::class);
    }
    public function country ()
    {
    	return $this->belongsTo('App\models\country','countries_id','id');
    } 
    public function city ()
    {
    	return $this->belongsTo('App\models\city','cities_id','id');
    }
     public function firmatipi ()
    {
    	return $this->belongsTo('App\models\firmatipi','firmatipi_id','id');
    }
     public function durum ()
    {
    	return $this->belongsTo('App\models\durum','durums_id','id');
    }
    public function firmadetay ()
    {
        return $this->hasMany(firmadetay::class);
    }
     public function alicisatici ()
    {
        return $this->belongsTo('App\models\alicisatici','alicisatici_id','id');
    }
    public function faturatipi ()
    {
        return $this->belongsTo(faturatipi::class);
    }
   /* public function nakliye1 ()
    {
        return $this->hasOne('App\modes\firma','nakliye1_id','id');
    }*/

     public function parent()
    {
        return $this->belongsTo(firma::class, 'nakliye1_id');
    }
     public function personel ()
    {
        return $this->belongsTo('App\models\personel');
    }
    public function kur ()
    {
        return $this->belongsTo('App\models\kur');
    }

}
