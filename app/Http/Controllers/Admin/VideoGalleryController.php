<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class VideoGalleryController extends Controller
{
    public function index(){
        return view('admin.videoGallery.index');
    }

    public function getVideos(){
        $videos = DB::table('video_galleries')
            ->select('video_galleries.*', 'album_types.type as album')
            ->join('album_types', 'video_galleries.type', '=', 'album_types.id')
            ->get();
        return Datatables::of($videos)->make(true);
    }

    public function store(Request $request){
        $photo = new VideoGallery();
        $request->validate([
            'photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:5048',
        ]);
        if($request->hasFile('photo')){
            $image = $request->photo;
            $new_name = time().'.'.$image->getClientOriginalName();
            $path = 'uploads/video_gallery';
            $image->move(public_path('uploads/video_gallery'), $new_name);
            $photo->image = $path.'/'.$new_name;
        }

        $photo->title = $request->title;
        $photo->tag = $request->tag;
        $photo->video_link = $request->video_link;
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
        $status = VideoGallery::find($request->video_id);
        $status->status=!$status->status;
        $status->save();
        if($status){
            return response()->json(['status' => true, 'data' => $status]);
        }else{
            return response()->json(['status' => false]);
        }
    }

    public function destroy($id){
        $video = VideoGallery::find($id);
        $image_path = public_path().'/'.$video->image;
        unlink($image_path);
        $video->delete();
        if($video){
            return response()->json(['status' => true]);
        }else{
            return response()->json(['status' => false]);
        }
    }

    public function edit($id){
        $video = VideoGallery::find($id);
        if($video){
            return response()->json(['status' => true, 'data' => $video]);
        }else{
            return response()->json(['status' => false]);
        }
    }

    public function update(Request $request){
        $video = VideoGallery::find($request->video_id);
        $request->validate([
            'photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:5048',
        ]);
        if($request->hasFile('photo')){
            $image_path = public_path().'/'.$video->image;
            unlink($image_path);
            $image = $request->photo;
            $new_name = time().'.'.$image->getClientOriginalName();
            $path = 'uploads/video_gallery';
            $image->move(public_path('uploads/video_gallery'), $new_name);
            $video->image = $path.'/'.$new_name;
        }

        $video->title = $request->title;
        $video->tag = $request->tag;
        $video->video_link = $request->video_link;
        $video->type = $request->type;
        $video->save();

        if($video){
            return response()->json(['status' => true]);
        }else{
            return response()->json(['status' => false]);
        }
    }

}
