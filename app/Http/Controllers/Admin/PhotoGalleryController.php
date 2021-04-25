<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PhotoGallery;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PhotoGalleryController extends Controller
{
    public function index(){
        return view('admin.photoGallery.index');
    }

    public function getPhotos(){
        $photos = DB::table('photo_galleries')
            ->select('photo_galleries.*', 'album_types.type as album')
            ->join('album_types', 'photo_galleries.type', '=', 'album_types.id')
            ->get();
        return Datatables::of($photos)->make(true);
    }

    public function store(Request $request){
        $photo = new PhotoGallery();

//        $validator = Validator::make($request->all(), [
//            'photo' => ['required|image|mimes:jpeg,png,jpg,gif,svg|max:10048'],
//        ]);
//        if($validator->fails()) {
//            return response()->json($validator->errors()->all(), 400);
//        }
        $request->validate([
            'photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:5048',
        ]);
        if($request->hasFile('photo')){
            $image = $request->photo;
            $new_name = time().'.'.$image->getClientOriginalName();
            $path = 'uploads/photo_gallery';
            $image->move(public_path('uploads/photo_gallery'), $new_name);
            $photo->image = $path.'/'.$new_name;
        }

        $photo->title = $request->title;
        $photo->tag = $request->tag;
        $photo->type = $request->type;
        $photo->save();

        if($photo){
            return response()->json(['status' => true]);
        }else{
            return response()->json(['status' => false]);
        }
    }

    public function status(Request $request)
    {
        $status = PhotoGallery::find($request->photo_id);
        $status->status=!$status->status;
        $status->save();
        if($status){
            return response()->json(['status' => true, 'data' => $status]);
        }else{
            return response()->json(['status' => false]);
        }
    }


    public function destroy($id){
        $photo = PhotoGallery::find($id);
        $image_path = public_path().'/'.$photo->image;
        unlink($image_path);
        $photo->delete();
        if($photo){
            return response()->json(['status' => true]);
        }else{
            return response()->json(['status' => false]);
        }
    }

    public function edit($id){
        $photo = PhotoGallery::find($id);
        if($photo){
            return response()->json(['status' => true, 'data' => $photo]);
        }else{
            return response()->json(['status' => false]);
        }
    }

    public function update(Request $request){
        $photo = PhotoGallery::find($request->photo_id);
        $request->validate([
            'photo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:5048',
        ]);
        if($request->hasFile('photo')){
            $image = $request->photo;
            $new_name = time().'.'.$image->getClientOriginalName();
            $path = 'uploads/photo_gallery';
            $image->move(public_path('uploads/photo_gallery'), $new_name);
            $photo->image = $path.'/'.$new_name;
        }

        $photo->title = $request->title;
        $photo->tag = $request->tag;
        $photo->type = $request->type;
        $photo->save();

        if($photo){
            return response()->json(['status' => true]);
        }else{
            return response()->json(['status' => false]);
        }
    }


}
