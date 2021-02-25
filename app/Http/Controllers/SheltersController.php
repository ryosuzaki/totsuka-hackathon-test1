<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shelter;
use App\User;
use Validator;
use Illuminate\Support\Facades\Auth;

class SheltersController extends Controller
{
    public function search(Request $request){
        return redirect()->route('shelter.home', ['id' => $request->id]);
    }
    //編集
    public function edit(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        $validator->sometimes('staff_password', 'alpha_dash', function ($request) {
            return $request->staff_password!="";
        });
        $validator->sometimes('user_password', 'alpha_dash', function ($request) {
            return $request->user_password!="";
        });
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $shelter=Shelter::where('id',$id)->first();
        $shelter->fill($request->except(['staff_password','user_password']));
        $shelter->updated_by=Auth::id();
        if($request->staff_password!=""){$shelter->staff_password=$request->staff_password;}
        if($request->user_password!=""){$shelter->user_password=$request->user_password;}
        $shelter->save();
        return redirect()->route('shelter.info.get', ['id' => $id]);
    }
    //認証ページ
    public function join($id){
        return view('shelter.join')->with(['shelter' => Shelter::where('id',$id)->first()]);
    }
    //利用者認証
    public function join_user(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'user_password' => 'required|alpha_dash',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        if(Shelter::where('id',$id)->first()->user_password==$request['user_password']){
            Shelter::find($id)->shelter_users()->attach(Auth::user()->id);
            return back();
        }else{
            return back()->withErrors(array('user_password' => 'パスワードが違います。'));
        }
    }
    public function exit_user($id){
        Shelter::find($id)->shelter_users()->detach(Auth::user()->id);
    }
    //スタッフ認証
    public function join_staff(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'staff_password' => 'required|alpha_dash',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        if(Shelter::where('id',$id)->first()->staff_password==$request['staff_password']){
            Shelter::find($id)->shelter_staffs()->attach(Auth::user()->id);
            return back();
        }else{
            return back()->withErrors(array('staff_password' => 'パスワードが違います。'));
        }
    }

    public function exit_staff($id){
        Shelter::find($id)->shelter_staffs()->detach(Auth::user()->id);
    }
    
    //登録
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'info' => '',
            'staff_password'=>'required|alpha_dash',
            'user_password'=>'required|alpha_dash',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $shelter=new Shelter();
        $shelter->fill($request->all());
        $shelter->updated_by=Auth::id();
        $shelter->save();
        return redirect()->route('shelter.info.get', ['id' => $shelter->id]);
    }
}
?>