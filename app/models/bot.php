<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class bot extends Model
{
    protected $table = 'bots';
    protected $fillable = ['barcode','type','users_id'];

    public function botdetail()
    {
    	return $this->hasMany(botdetail::class);
    }
}
