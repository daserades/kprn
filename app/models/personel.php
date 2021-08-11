<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class personel extends Model
{
    protected $table='personels';
    protected $fillable =['name','surname','tel','departman_id','gorevlistesis_id','gtrh','ctrh','durums_id','users_id','adres'];

	public function user()
	{
		return $this->belongsTo('App\User','users_id','id');
	}
    public function durum()
	{
		return $this->belongsTo('App\models\durum','durums_id','id');
	}
	public function departman()
	{
		return $this->belongsTo('App\models\departman','departman_id','id');
	}
	public function gorevlistesi()
	{
		return $this->belongsTo('App\models\gorevlistesi','gorevlistesis_id','id');
	}
}
