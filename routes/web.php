<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Http\Controllers\PostController;
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

// Route::get('/', function () {
    
//     //This was what to change if you have a N+1 problem 
//     // $posts = Post::all();

//     // return view('welcome', [
//     //     'posts' => $posts
//     // ]);
//     // return ['foo' => 'bar'];

//     // $files = File::files(resource_path('posts'));
//     // documents = [];
//     // first method is using loop
//     // foreach ($files as $file)
//     // {
//     //     $documents = YamlFrontMatter::parseFile($file);

//     //     $posts[] = new Post(
//     //         $documents->title,
//     //         $documents->excerpt,
//     //         $documents->date,
//     //         $documents->body(),
//     //         $documents->slug
//     //     );
//     // }

//     // documents = [];
//     // second method is using array map
//     // $posts = array_map(function ($file){
//     //     $documents = YamlFrontMatter::parseFile($file);
        
//     //     return new Post(
//     //         $documents->title,
//     //         $documents->excerpt,
//     //         $documents->date,
//     //         $documents->body(),
//     //         $documents->slug
//     //     );
//     // }, $files);

//     // third method is using collection
    
//     // $posts = collect($files)
//     //     ->map(function($file){
//     //         return YamlFrontMatter::parseFile($file);
//     //     })
//     //     ->map(function($documents){
//     //         return new Post(
//     //             $documents->title,
//     //             $documents->excerpt,
//     //             $documents->date,
//     //             $documents->body(),
//     //             $documents->slug
//     //         );
//     //     });

//     // first method in debugging what happens in the sql query execution and $query->bindings means that it will display the id like `categories`.`id` = ? limit 1 [1]
//     // \Illuminate\Support\Facades\DB::listen(function($query){
//     // //\Illuminate\Support\Facades\Log::info();
//     //  //is the same as
      
//     //     logger($query->sql, $query->bindings);
      
//     //  });
    
//     // solution if you have N+1 problem
//     //  return view('posts', [
//         // this has N+1 solution but do not sort the post properly by published_at
//         // 'posts' => Post::with('category')->get()

//         // this has N+1 solution but do sort the post properly by published_at
//         // 'posts' => Post::latest("published_at")->with(['category', 'author'])->get(),
//         // 'categories' => Category::all()
//         // alternative of eager load
//         // 'posts' => Post::latest("published_at")->get()

//         //  alternative sa eager load ug without ato
//         // 'posts' => Post::without(["author", "category"])->get()
//     // ]);

//     // search filter 
//     $posts = Post::latest("published_at")->with(['category', 'author']);
//     // dd(request('search'));
//     if(request('search'))
//     {
//         $posts
//             ->where('title', 'like', '%' . request('search') . '%')
//             ->orWhere('body', 'like', '%' . request('search') . '%');
//     }

//     return view('posts', [
        
//         'posts' => $posts->get(),
//         'categories' => Category::all()
        
//     ]);
    
//     // solution sa episode 35, isearch sa gdocs = solves the problem how do I set the current link active? 
// })->name('home');





// using post:slug for using slug instead id 
// Route::get('posts/{post:slug}', function(Post $post){
//     // $post = Post::find($id);

//     // return view('post', [
//     //     'post'=> $post
//     //     // 'post' => '<h1> Hi </h1>'
//     // ]);


//     // using route model binding only this
//     return view('post', [
//             // with eager load
//             'post'=> $post->load(['category', 'author']),
//             'categories' => Category::all()

//             // alternative sa eager load
//             // 'post'=> $post

//             // alternative sa eager load ug without ato
//             // 'post'=> $post->without(['author', 'category'])
//     ]);
//     // constraints sa wild card if dili matuman ang constraints pag return sya ug page 404 not found
// });



// passed to the postController 
Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('posts/{post:slug}', [PostController::class, 'show']);



// ep16 removed 
// })->where('post', '[A-z_\-]+');

// Route::get('/categories/{category:slug}', function(Category $category){
//     // dd($category->posts); pag feel nimo na dli ma access etry lang ug loop
//     return view('posts', [
//             // with eager load
//             'posts'=> $category->posts->load(['category', 'author']),
//             'categories' => Category::all(),
//             'currentCategory' => $category

//             // alternative sa eager load
//             // 'posts'=> $category->posts

//             // alternative sa eager load ug without ato
//             // 'posts'=> $category->posts->without(["author", "category"])
//     ]);
// })->name('category');

// Route::get('/authors/{author:username}', function(User $author){
    
//     return view('posts.index', [
//             // eager load
//             'posts'=> $author->posts->load(['category', 'author'])

//             // there is alternative of doing this eager post naa sa App\Models\Post tas pangita ang protected $with tas dani sa route kay wala-on nimo ang mga with() load()
//             // 'posts'=> $author->posts  

//             // alternative sa eager load ug without ato
//             // 'posts'=> $author->posts->without(["author", "category"])
//         ]);
// });