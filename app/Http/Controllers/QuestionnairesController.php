<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\User;
use App\SafetyQuestionnaire;
use App\HealthQuestionnaire;

class QuestionnairesController extends Controller
{
    //
    public function form(Request $request,$type){
        if($type=="safety"){
            $validator = Validator::make($request->all(), [
                'Q1' => 'required',
            ]);
            $db=new SafetyQuestionnaire();
        }
        if($type=="health"){
            $validator = Validator::make($request->all(), [
                'Q1' => 'required',
            ]);
            $db=new HealthQuestionnaire();
        }
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $db->fill($request->all());
        $db->user_id=Auth::id();
        $db->save();
        return redirect()->route('questionnaire.home');
    }
/*
    public function answers($type,$id){
        if($type=="safety"){
            return view('questionnaire.safety.answers')->with(['answers'=>User::find($id)->safety_questionnaires()->get()]);
        }
        if($type=="health"){
            return view('questionnaire.health.answers')->with(['answers'=>User::find($id)->health_questionnaires()->get()]);
        }
    }
*/
    public function answers($id){
        return view('questionnaire.answers')->with([
            'safety_answers'=>User::find($id)->safety_questionnaires()->orderBy('created_at','desc')->get(),
            'health_answers'=>User::find($id)->health_questionnaires()->orderBy('created_at','desc')->get(),
            ]);   
    }
    public function answer($type,$user_id,$answer_id){
        if($type=="safety"){
            $q=new SafetyQuestionnaire();
            return view('questionnaire.safety.answer')->with(['answer'=>SafetyQuestionnaire::find($answer_id),'user'=>User::find($user_id),'questions'=>$q->questions]);
        }
        if($type=="health"){
            $q=new HealthQuestionnaire();
            return view('questionnaire.health.answer')->with(['answer'=>HealthQuestionnaire::find($answer_id),'user'=>User::find($user_id),'questions'=>$q->questions]);
        }
    }
}
