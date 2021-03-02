<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SafetyQuestionnaire extends Model
{
    //
    protected $fillable = ['id','user_id','created_at','updated_at','Q1'];

    //質問内容
    public $questions=[
        '現在の状況を教えて下さい。',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
