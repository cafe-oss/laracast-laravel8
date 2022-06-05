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
    // $files = File::files(resource_path('posts'));
   
    // first method is using loop
    // foreach ($files as $file)
    // {
    //     $documents = YamlFrontMatter::parseFile($file);

    //     $posts[] = new Post(
    //         $documents->title,
    //         $documents->excerpt,
    //         $documents->date,
    //         $documents->body(),
    //         $documents->slug
    //     );
    // }

    // second method is using array map
    // $posts = array_map(function ($file){
    //     $documents = YamlFrontMatter::parseFile($file);
        
    //     return new Post(
    //         $documents->title,
    //         $documents->excerpt,
    //         $documents->date,
    //         $documents->body(),
    //         $documents->slug
    //     );
    // }, $files);

    // third method is using collection
    
    // $posts = collect($files)
    //     ->map(function($file){
    //         return YamlFrontMatter::parseFile($file);
    //     })
    //     ->map(function($documents){
    //         return new Post(
    //             $documents->title,
    //             $documents->excerpt,
    //             $documents->date,
    //             $documents->body(),
    //             $documents->slug
    //         );
    //     });

     return view('welcome', [
        'posts' => $posts
    ]);
    
    // return view('welcome', [
    //     'posts' => $posts
    // ]);
    // return ['foo' => 'bar'];
});

Route::get('posts/{post}', function($slug){
    $post = Post::find($slug);

    return view('post', [
        'post'=> $post
        // 'post' => '<h1> Hi </h1>'
    ]);

    // constraints sa wild card if dili matuman ang constraints pag return sya ug page 404 not found
});
// ep16 removed 
// })->where('post', '[A-z_\-]+');
