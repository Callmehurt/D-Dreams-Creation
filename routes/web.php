<?php

use Illuminate\Support\Facades\Route;


//Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\PhotoGalleryController;
use App\Http\Controllers\Admin\VideoGalleryController;
use App\Http\Controllers\Admin\PackageController;

//Route::get('/', function (){
//   return redirect()->route('dashboard');
//});

Route::get('/admin', [LoginController::class, 'index'])->name('login');
Route::post('/login/user', [LoginController::class, 'doLogin'])->name('login.user');
Route::get('/logout/user', [LoginController::class, 'logout'])->name('logout.user');


//Frontend routes
Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/test', function (){
    return view('frontend.pages.test');
});


//Backend routes
Route::group(['prefix' => 'admin', 'middleware' => ['role:superadministrator|administrator']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //album management routes
    Route::get('/album/list', [AlbumController::class, 'index'])->name('album.list');
    Route::get('/album/list/all', [AlbumController::class, 'albumList'])->name('album.getList');
    Route::post('/album/add', [AlbumController::class, 'store'])->name('album.store');
    Route::post('/album/status', [AlbumController::class, 'status'])->name('album.status');
    Route::get('/album/destroy', [AlbumController::class, 'destroy'])->name('album.destroy');
    Route::get('/album/detail', [AlbumController::class, 'getAlbumDetail'])->name('album.getAlbumDetail');
    Route::post('/album/update', [AlbumController::class, 'update'])->name('album.update');

    //Photo gallery routes
    Route::get('/photo/gallery', [PhotoGalleryController::class, 'index'])->name('photo_gallery.index');
    Route::get('/getPhotos', [PhotoGalleryController::class, 'getPhotos'])->name('photo_gallery.getPhotos');
    Route::post('/photo/gallery/store', [PhotoGalleryController::class, 'store'])->name('photo_gallery.store');
    Route::post('/status', [PhotoGalleryController::class, 'status'])->name('photo_gallery.status');
    Route::get('/photo/destroy/{id}', [PhotoGalleryController::class, 'destroy'])->name('photo_gallery.destroy');
    Route::get('/edit/{id}', [PhotoGalleryController::class, 'edit'])->name('photo_gallery.edit');
    Route::post('/update/photo', [PhotoGalleryController::class, 'update'])->name('photo_gallery.update');


    //Video gallery routes
    Route::get('/videos/list', [VideoGalleryController::class, 'index'])->name('video_gallery.index');
    Route::get('/videos/getVideos', [VideoGalleryController::class, 'getVideos'])->name('video_gallery.getVideos');
    Route::post('/video/store', [VideoGalleryController::class, 'store'])->name('video_gallery.store');
    Route::post('/video/status', [VideoGalleryController::class, 'status'])->name('video_gallery.status');
    Route::get('/video/destroy/{id}', [VideoGalleryController::class, 'destroy'])->name('video_gallery.destroy');
    Route::get('/video/edit/{id}', [VideoGalleryController::class, 'edit'])->name('video_gallery.edit');
    Route::post('/video/update', [VideoGalleryController::class, 'update'])->name('video_gallery.update');



});

Route::group(['prefix' => 'admin', 'middleware' => ['role:superadministrator']], function() {
    Route::get('/register/user', [RegisterController::class, 'index'])->name('register.page');
    Route::post('/register/user', [RegisterController::class, 'register'])->name('register.user');
    Route::get('/list/user', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.list');
    Route::get('/get/user', [\App\Http\Controllers\Admin\UserController::class, 'getUsers'])->name('getUsers');
    Route::get('/destroy/user', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('user.destroy');


    //Packages routes
    Route::get('/packages/list', [PackageController::class, 'index'])->name('package.index');
    Route::get('/packages/getPckages', [PackageController::class, 'getPckages'])->name('package.getPckages');
    Route::post('/package/store', [PackageController::class, 'store'])->name('package.store');
    Route::post('/package/status', [PackageController::class, 'status'])->name('package.status');
    Route::get('/package/destroy/{id}', [PackageController::class, 'destroy'])->name('package.destroy');
    Route::get('/package/edit/{id}', [PackageController::class, 'edit'])->name('package.edit');
    Route::post('/package/update', [PackageController::class, 'update'])->name('package.update');

});

//Route::group(['middleware' => ['auth']], function () {
//    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
//    Route::get('/register/user', [RegisterController::class, 'index'])->name('register.page');
//    Route::post('/register/user', [RegisterController::class, 'register'])->name('register.user');
//});