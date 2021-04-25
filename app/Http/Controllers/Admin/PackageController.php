<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PackageController extends Controller
{
    public function index(){
        return view('admin.packages.index');
    }

    public function getPckages(){
        $packages = Package::all();
        return Datatables::of($packages)->make(true);
    }

    public function store(Request $request){
        $package = new Package();
        $request->validate([
            'photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:5048',
        ]);
        if($request->hasFile('photo')){
            $image = $request->photo;
            $new_name = time().'.'.$image->getClientOriginalName();
            $path = 'uploads/packages';
            $image->move(public_path('uploads/packages'), $new_name);
            $package->image = $path.'/'.$new_name;
        }

        $package->title = $request->title;
        $package->amount = $request->amount;
        $package->description = $request->package_description;
        $package->user_id = Auth::user()->id;
        $package->save();

        if($package){
            return response()->json(['status' => true]);
        }else{
            return response()->json(['status' => false]);
        }
    }

    public function status(Request $request)
    {
        $status = Package::find($request->video_id);
        $status->status=!$status->status;
        $status->save();
        if($status){
            return response()->json(['status' => true, 'data' => $status]);
        }else{
            return response()->json(['status' => false]);
        }
    }

    public function destroy($id){
        $package = Package::find($id);
        $image_path = public_path().'/'.$package->image;
        unlink($image_path);
        $package->delete();
        if($package){
            return response()->json(['status' => true]);
        }else{
            return response()->json(['status' => false]);
        }
    }

    public function edit($id){
        $package = Package::find($id);
        if($package){
            return response()->json(['status' => true, 'data' => $package]);
        }else{
            return response()->json(['status' => false]);
        }
    }

    public function update(Request $request){
        $package = Package::find($request->package_id);
        if($request->hasFile('phone')){
            $request->validate([
                'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:5048',
            ]);
        }
        if($request->hasFile('photo')){
            $image_path = public_path().'/'.$package->image;
            unlink($image_path);
            $image = $request->photo;
            $new_name = time().'.'.$image->getClientOriginalName();
            $path = 'uploads/packages';
            $image->move(public_path('uploads/packages'), $new_name);
            $package->image = $path.'/'.$new_name;
        }

        $package->title = $request->title;
        $package->amount = $request->amount;
        $package->description = $request->package_description;
        $package->save();

        if($package){
            return response()->json(['status' => true]);
        }else{
            return response()->json(['status' => false]);
        }
    }
}
