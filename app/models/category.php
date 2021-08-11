<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table='categories';
    protected $fillable=['name','parent_id','users_id'];

     public function parent()
    {
        return $this->belongsTo(category::class, 'parent_id');
    }
    public function children()
    {
        return $this->hasMany(category::class, 'parent_id');
    }
    public function childrenRecursive()
	{
	   return $this->children()->with('childrenRecursive');
	}
    public function urun()
    {
        return $this->belongsToMany(Urun::class, 'categories_uruns','category_id','urun_id')->where('durum_id',1);
    }
}
