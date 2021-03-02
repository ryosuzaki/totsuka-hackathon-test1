<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //
    public function belong(){
        return view('user.belong')->
        with([
            'staff_shelters'=>User::find(Auth::id())->staff_shelters()->get(),
            'user_shelters'=>User::find(Auth::id())->user_shelters()->get(),
            'staff_supports'=>User::find(Auth::id())->staff_supports()->get(),
            'user_supports'=>User::find(Auth::id())->user_supports()->get(),
        ]);
    }
}
