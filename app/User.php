<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //多対多リレーション定義
    public function staff_shelters(){
        return $this->belongsToMany('App\Shelter', 'shelter_staffs', 'user_id', 'shelter_id');
    }
    //
    public function user_shelters(){
        return $this->belongsToMany('App\Shelter', 'shelter_users', 'user_id', 'shelter_id');
    }
    //
    public function staff_supports(){
        return $this->belongsToMany('App\SupportTeam', 'support_staffs', 'user_id', 'support_team_id');
    }
    //
    public function user_supports(){
        return $this->belongsToMany('App\SupportTeam', 'support_users', 'user_id', 'support_team_id');
    }
    

    //
    public function safety_questionnaires(){
        return $this->hasMany('App\SafetyQuestionnaire','user_id');
    }
    //
    public function health_questionnaires(){
        return $this->hasMany('App\HealthQuestionnaire','user_id');
    }
}
