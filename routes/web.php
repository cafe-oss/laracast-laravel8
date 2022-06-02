<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
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
    $posts = Post::all();
    return view('welcome', [
        'posts' => $posts
    ]);
    // return ['foo' => 'bar'];
});

Route::get('posts/{post}', function($slug){
    $post = Post::find($slug);

    return view('post', [
        'post'=> $post
        // 'post' => '<h1> Hi </h1>'
    ]);

    // constraints sa wild card if dili matuman ang constraints pag return sya ug page 404 not found
})->where('post', '[A-z_\-]+');
