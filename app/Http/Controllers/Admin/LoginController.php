<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        if(Auth::check()){
            return redirect()->route('dashboard');
        }else{
            return view('admin.pages.login');
        }
    }

    public function doLogin(Request $request)
    {
        $rules = array(
            'email'    => 'required|email', // make sure the email is an actual email
            'password' => 'required|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('error', $validator) // send back all errors to the login form
                ->withInput($request->except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {

            // create our user data for the authentication
            $userdata = array(
                'email' 	=> $request->input('email'),
                'password' 	=> $request->input('password')
            );

            // attempt to do the login
            if (Auth::attempt($userdata)) {
                return redirect()->route('dashboard');
            } else {
                // validation not successful, send back to form
                return redirect()->back()->with('error', 'Record not found with these credentials!');

            }

        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

}
