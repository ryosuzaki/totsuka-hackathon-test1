<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shelter;
use Validator;

class SheltersController extends Controller
{
    //
    public function info($id)
    {
        return view('shelters.info')->with(['shelter_info' => Shelter::where('id',$id)->first() ]);
    }



    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'info' => '',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $shelter=Shelter::create($request->all());
        return redirect()->route('shelter_info', ['id' => $shelter->id]);
    }
}
?>