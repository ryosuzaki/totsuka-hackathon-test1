<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shelter extends Model
{
    //
    protected $fillable = ['id', 'created_at','updated_at','name','degree_of_congestion','info'];
}
