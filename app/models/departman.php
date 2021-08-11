<?php

namespace App\models;


use Illuminate\Database\Eloquent\Model;

class departman extends Model
{
    protected $table = 'departman';
    protected $fillable = ['name']; 
/*
    public function personel()
    {
    	return $this->hasOne('App\models\personel',"departman_tb_id");
    }*/
}
