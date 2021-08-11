<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class botdetail extends Model
{
    protected $table = 'botdetails';
    protected $fillable = ['bot_id','barcode','urun_id','users_id'];
    
    public function bot()
    {
    	return $this->belongsTo(bot::class);
    }
    public function urun()
    {
    	return $this->belongsTo(urun::class);
    }
}
