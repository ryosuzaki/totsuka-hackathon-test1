<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SupportTeam;
use App\User;
use Validator;
use Illuminate\Support\Facades\Auth;

class SupportTeamsController extends Controller
{
    public function search(Request $request){
        return redirect()->route('support_team.home', ['id' => $request->id]);
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
        $support_team=SupportTeam::where('id',$id)->first();
        $support_team->fill($request->except(['staff_password','user_password']));
        $support_team->updated_by=Auth::id();
        if($request->staff_password!=""){$support_team->staff_password=$request->staff_password;}
        if($request->user_password!=""){$support_team->user_password=$request->user_password;}
        $support_team->save();
        return redirect()->route('support_team.info.get', ['id' => $id]);
    }
    //認証
    public function join($id){
        return view('support_team.join')->with(['support_team' => SupportTeam::where('id',$id)->first() ]);
    }
    //利用者認証
    public function join_user(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'user_password' => 'required|alpha_dash',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        if(SupportTeam::where('id',$id)->first()->user_password==$request['user_password']){
            SupportTeam::find($id)->support_users()->attach(Auth::user()->id);
            return back();
        }else{
            return back()->withErrors(array('user_password' => 'パスワードが違います。'));
        }
    }
    public function exit_user($id){
        SupportTeam::find($id)->support_users()->detach(Auth::user()->id);
    }
    //スタッフ認証
    public function join_staff(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'staff_password' => 'required|alpha_dash',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        if(SupportTeam::where('id',$id)->first()->staff_password==$request['staff_password']){
            SupportTeam::find($id)->support_staffs()->attach(Auth::user()->id);
            return back();
        }else{
            return back()->withErrors(array('staff_password' => 'パスワードが違います。'));
        }
    }

    public function exit_staff($id){
        SupportTeam::find($id)->support_staffs()->detach(Auth::user()->id);
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
        $support_team=new SupportTeam();
        $support_team->fill($request->all());
        $support_team->updated_by=Auth::id();
        $support_team->save();
        
        return redirect()->route('support_team.info.get', ['id' => $support_team->id]);
    }

    public function users(Request $request,$id){
        $collisions=null;
        if(isset($request->help_users_id)){
            foreach ($request->help_users_id as $user_id){
                $user=User::find($user_id);
                if($user->help_by==null){
                    $user->help_by=Auth::id();
                    $user->save();
                }else{
                    $collisions[]=$user->name;
                }
            }
        }
        if(isset($request->quit_users_id)){
            foreach ($request->quit_users_id as $user_id){
                $user=User::find($user_id);
                $user->help_by=null;
                $user->save();
            }
        }
        if($collisions){
            return redirect()->route('support_team.users.get', ['id' => $id])->with('flash_message', implode( ',', $collisions).'で他の職員が先に担当に就きました。');
        }else{
            return redirect()->route('support_team.users.get', ['id' => $id]);
        }
    }
}
?>
