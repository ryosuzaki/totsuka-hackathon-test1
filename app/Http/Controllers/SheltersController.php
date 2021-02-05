<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shelter;
use Validator;

class SheltersController extends Controller
{
    //
    public function get_info($code)
    {
        return view('shelters.get_info')->with(['shelter_info' => Shelter::where('code',$code)->first() ]);
    }



    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|max:50|unique:shelters,code|alpha_num',
            'name' => 'required|max:100',
            #'location' => 'required',
            'info' => '',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        Shelter::create($request->all());
        return redirect('home');
    }
}
