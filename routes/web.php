<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\Category;

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
    
    //This was what to change if you have a N+1 problem 
    // $posts = Post::all();

    // return view('welcome', [
    //     'posts' => $posts
    // ]);
    // return ['foo' => 'bar'];

    // $files = File::files(resource_path('posts'));
    // documents = [];
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

    // documents = [];
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

    // first method in debugging what happens in the sql query execution and $query->bindings means that it will display the id like `categories`.`id` = ? limit 1 [1]
    // \Illuminate\Support\Facades\DB::listen(function($query){
    // //\Illuminate\Support\Facades\Log::info();
    //  //is the same as
      
    //     logger($query->sql, $query->bindings);
      
    //  });
    
    // solution if you have N+1 problem
     return view('welcome', [
        'posts' => Post::with('category')->get()
    ]);
    
    
});
// using post:slug for using slug instead id 
Route::get('posts/{post:slug}', function(Post $post){
    // $post = Post::find($id);

    // return view('post', [
    //     'post'=> $post
    //     // 'post' => '<h1> Hi </h1>'
    // ]);


    // using route model binding only this
    return view('post', [
            'post'=> $post
        ]);


    // constraints sa wild card if dili matuman ang constraints pag return sya ug page 404 not found
});
// ep16 removed 
// })->where('post', '[A-z_\-]+');

Route::get('/categories/{category:slug}', function(Category $category){
    // dd($category->posts); pag feel nimo na dli ma access etry lang ug loop
    return view('welcome', [
            'posts'=> $category->posts
        ]);

});