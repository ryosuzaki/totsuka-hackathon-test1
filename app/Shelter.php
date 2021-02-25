<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shelter extends Model
{
    //
    protected $fillable = ['id','updated_by', 'created_at','updated_at','name','degree_of_congestion','info','staff_password','user_password'];

    protected $hidden = ['staff_password','user_password'];
    
    //多対多リレーション定義
    public function shelter_staffs(){
        return $this->belongsToMany('App\User', 'shelter_staffs', 'shelter_id', 'user_id');
    }
    
    public function shelter_users(){
        return $this->belongsToMany('App\User', 'shelter_users', 'shelter_id', 'user_id');
    } 
}
