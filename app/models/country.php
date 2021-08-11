<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class country extends Model
{
    protected $table= 'countries';
    protected $fillable=['name'];
}
