<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlbumType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AlbumController extends Controller
{
    public function index(){
        return view('admin.albumType.index');
    }

    public function albumList(){
        $album = AlbumType::all();
        return Datatables::of($album)->make(true);
    }

    public function store(Request $request){
        $album = AlbumType::create([
           'type' => $request->title
        ]);
        if($album){
            return response()->json(['status' => true, 'data' => $album]);
        }else{
            return response()->json(['status' => false]);
        }
    }

    public function status(Request $request)
    {
        $status = AlbumType::find($request->album_id);
        $status->status=!$status->status;
        $status->save();
        if($status){
            return response()->json(['status' => true, 'data' => $status]);
        }else{
            return response()->json(['status' => false]);
        }
    }

    public function destroy(Request $request){
        $album = AlbumType::find($request->album_id);
        $album->delete();
        if($album){
            return response()->json(['status' => true]);
        }else{
            return response()->json(['status' => false]);
        }
    }

    public function getAlbumDetail(Request $request){
        $detail = AlbumType::find($request->album_id);
        return response()->json($detail);
    }

    public function update(Request $request){
        $update = AlbumType::find($request->album_id)->update([
           'type' => $request->title
        ]);
        if($update){
            return response()->json(['status' => true]);
        }else{
            return response()->json(['status' => false]);
        }
    }
}
