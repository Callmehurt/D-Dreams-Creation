<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(){
        return view('admin.pages.users');
    }

    public function getUsers(){
        $users =User::all()->except(Auth::user()->id);
        return Datatables::of($users)->make(true);
    }

    public function destroy(Request $request)
    {
        $user = User::findorFail($request->user_id);
        $image_path = public_path().'/uploads/profile_pics/'.$user->profile_pic;
        unlink($image_path);
        $user->delete();
        return response()->json(["status" => true]);
    }
}
