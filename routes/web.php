<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\NewsletterController;
use MailchimpMarketing\ApiClient;
use App\Services\Newsletter;
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

// passed to the postController 
Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('posts/{post:slug}', [PostController::class, 'show']);

//section 9 forms and authentication 
Route::get('register', [RegisterController::class,'create'])->middleware('guest');
Route::post('register', [RegisterController::class,'store'])->middleware('guest');

//section 9 logout and login
Route::post('logout', [SessionController::class,'destroy'])->middleware('auth');
Route::get('login', [SessionController::class,'create'])->middleware('guest');
Route::post('login', [SessionController::class,'store'])->middleware('guest');

// section 10 active the comment form 
Route::post('posts/{post:slug}/comments', [PostCommentsController::class,'store'])->middleware('auth');

// section 11
 
// Route::get('ping', function(){
   
//     $mailchimp = new \MailchimpMarketing\ApiClient();
     
//     $mailchimp->setConfig([
//         'apiKey' => config('services.mailchimp.key'),
//         'server' => 'us14',
//     ]);
     
//     $response = $mailchimp->ping->get();
//     // $response = $mailchimp->lists->getAllLists();
//     // $response = $mailchimp->lists->getList('d617facd7f');
//     // $response = $mailchimp->lists->getListMembersInfo('d617facd7f');
//     // $response = $mailchimp->lists->addListMember('d617facd7f', [
//     //     'email_address' => 'cut3alvin@gmail.com',
//     //     'status' => 'subscribed',
//     // ]);

//     dd($response);
// });

// first and simple approach of control flow of the project
// Route::post('newsletter', function(){
//     request()->validate(['email'=>'required|email']);

//     try {
//         $newsletter = new Newsletter();
//         $newsletter->subscribe(request('email'));

//     } catch (\Exception $th) {
//         throw \Illuminate\Validation\ValidationException::withMessages([
//             'email' => 'This email could not be added to our newsletter list'
//         ]);
//     }

//     return redirect('/')->with('success', 'You are now signed up for our newsletter');

// });
    
// second approach using the injection
// Route::post('newsletter', function(Newsletter $newsletter){
//     request()->validate(['email'=>'required|email']);

//     try {
//         $newsletter->subscribe(request('email'));

//     } catch (\Exception $th) {
//         throw \Illuminate\Validation\ValidationException::withMessages([
//             'email' => 'This email could not be added to our newsletter list because it may be invalid or is already in our list',
//         ]);
//     }

//     return redirect('/')->with('success', 'You are now signed up for our newsletter');

// });

// second approach with controller
Route::post('newsletter', NewsletterController::class);

// section12 using the middleware 'admin'
// Route::get('admin/posts/create', [AdminPostController::class, 'create'])->middleware('admin');
// Route::post('admin/posts', [AdminPostController::class, 'store'])->middleware('admin');

// Route::get('admin/posts', [AdminPostController::class, 'index'])->middleware('admin');
// Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit'])->middleware('admin');
// Route::patch('admin/posts/{post}', [AdminPostController::class, 'update'])->middleware('admin');
// Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy'])->middleware('admin');

// section12 using the middleware 'admin' with 'can'
// Route::get('admin/posts/create', [AdminPostController::class, 'create'])->middleware('can:admin');
// Route::post('admin/posts', [AdminPostController::class, 'store'])->middleware('can:admin');
// Route::get('admin/posts', [AdminPostController::class, 'index'])->middleware('can:admin');
// Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit'])->middleware('can:admin');
// Route::patch('admin/posts/{post}', [AdminPostController::class, 'update'])->middleware('can:admin');
// Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy'])->middleware('can:admin');

// section12 group the routes with the same middleware first approach
// Route::middleware('can:admin')->group(function(){
//     Route::get('admin/posts/create', [AdminPostController::class, 'create'])->middleware('can:admin');
//     Route::post('admin/posts', [AdminPostController::class, 'store'])->middleware('can:admin');
//     Route::get('admin/posts', [AdminPostController::class, 'index'])->middleware('can:admin');
//     Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit'])->middleware('can:admin');
//     Route::patch('admin/posts/{post}', [AdminPostController::class, 'update'])->middleware('can:admin');
//     Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy'])->middleware('can:admin');
// });

// section12 group the routes with the same middleware second approach
Route::middleware('can:admin')->group(function(){
    Route::resource('admin/posts', AdminPostController::class)->except('show');
});