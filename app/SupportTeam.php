<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportTeam extends Model
{
    //
    protected $fillable=['id','updated_by','created_at','updated_at','name','info','staff_password','user_password'];

    protected $hidden = ['staff_password','user_password'];

    //多対多リレーション定義
    public function support_staffs(){
        return $this->belongsToMany('App\User', 'support_staffs', 'support_team_id', 'user_id');
    }
    //
    public function support_users(){
        return $this->belongsToMany('App\User', 'support_users', 'support_team_id', 'user_id');
    }
}
