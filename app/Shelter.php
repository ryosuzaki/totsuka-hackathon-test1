<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shelter extends Model
{
    //
    protected $fillable = ['code', 'created_at','updated_at','name',/*'location',*/'degree_of_congestion','info'];
}
