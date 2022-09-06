<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Http\Controllers\MyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', 'MyController@showAbout');

Route::get('/testmodel', function() {
    $posts = Post::all();
    return $posts;
});

Auth::routes();

//Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth'],
'prefix' => 'client-area'], function (){
    // Route::get('/', function () {
    //     return view('home');
    // });

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
});

Route::group(['prefix' => 'admin','middleware'=> 
    ['auth', 'isAdmin']],function(){
    Route::get('profile',function()
    {
        return view('profile');
    });
});
    Route::get('/errors', function()
    {
        return view ('403');
    });