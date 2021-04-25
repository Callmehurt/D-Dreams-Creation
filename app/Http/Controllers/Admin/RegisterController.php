<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    public function index(){
        return view('admin.pages.register');
    }

    public function register(Request $request){
        if($request->ajax()){
            $this->validate($request, [
                'fullname' => ['required', 'max:100'],
                'email' => ['required'],
                'password' => ['required'],
            ]);

            $validator = Validator::make($request->all(), [
                'fullname' => ['required', 'max:100'],
                'email' => ['required', 'unique:users'],
                'password' => ['required'],
            ]);
            if($validator->fails()) {
                return response()->json($validator->errors()->all(), 400);
            }

            $user = new User();
            if($request->hasFile('profile_pic')){
                $image = $request->profile_pic;
                $new_name = time().'.'.$image->getClientOriginalName();
                $image->move(public_path('uploads/profile_pics'), $new_name);
                $user->profile_pic = $new_name;
            }
            $user->name = $request->fullname;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            $user->attachRole('administrator');
            if($user){
                return response()->json($user);
            }else{
                return response()->json(['message' => 'Registration Failed!']);
            }
        }
    }
}
