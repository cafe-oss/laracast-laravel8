<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index()
    {
        // // search filter 
        // $posts = Post::latest("published_at")->with(['category', 'author']);
        // // dd(request('search'));
        // if(request('search'))
        // {
        //     $posts
        //         ->where('title', 'like', '%' . request('search') . '%')
        //         ->orWhere('body', 'like', '%' . request('search') . '%');
        // }

        // second approach of clean search
        // return view('posts.index', [
            

            // 'posts' => Post::latest("published_at")->filter(request(['search', 'category', 'author']))->get()
            // 'categories' => Category::all(),
            //kaning firstWhere kay same sa Route::get('/categories/{category:slug}', function(Category $category)
            // kay pangitaon niya ang slug sa given na ge search na category
            // 'currentCategory' => Category::firstWhere('slug', request('category'))
            
            // paginate
            // 'posts' => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(6)->withQueryString()

        // ]);

        // section 12, admin
        // first approach use of GATE facades
        // dd(Gate::allows('admin'));

        // second approach 
        // dd(request()->user()->can('admin'));

        // third approach is using the authrize() 
        // dd($this->authorize('admin'));

        // more solution in about admin authorization on layout-section5

        return view('posts.index', [
            'posts' => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(6)->withQueryString()

        ]);


    }

    public function show(Post $post)
    {

        return view('posts.show', [

            'post'=> $post->load(['category', 'author']),
            'categories' => Category::all()
        ]);
    }

    // first approach of clean search
    // protected function getPosts(){
    //     // search filter 
    //     $posts = Post::latest("published_at")->with(['category', 'author']);
    //     // dd(request('search'));
    //     if(request('search'))
    //     {
    //         $posts
    //             ->where('title', 'like', '%' . request('search') . '%')
    //             ->orWhere('body', 'like', '%' . request('search') . '%');
    //     }
    //     return $posts->get();
    // }

    // this is passed to the adminpostController
    // public function create()
    // {
    //     // first approach
    //     // if(auth()->guest()){
    //     //     abort(Response::HTTP_FORBIDDEN);
            
    //     // }

    //     // if(auth()->user()->username !== 'jhondoe'){
    //     //     abort(Response::HTTP_FORBIDDEN);
    //     // }

    //     // second approach or this abort_if(auth()->user()?->username !== 'jhondoe', Response::HTTP_FORBIDDEN);
    //     // if(auth()->user()?->username !== 'jhondoe'){
    //     //     abort(Response::HTTP_FORBIDDEN);
    //     // }

    //     // third approach is to create a 'admin' middleware, goto the MustbeAdmin and migrate the second approach

    //     return view('admin.posts.create');
    // }


    // this is passed to the adminpostController
    // public function store()
    // {

    //     $attributes = request()->validate([
    //         'title' => 'required',
    //         'slug' => ['required', Rule::unique('posts', 'slug')],
    //         'excerpt' => 'required',
    //         'body' => 'required',
    //         'category_id' => ['required', Rule::exists('categories', 'id')],
    //     ]);


    //     $attributes['user_id'] = auth()->id();

    //     // $path = request()->file('thumbnail')->store('thumbnails');

    //     // return 'done'. $path;

    //     $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');

    //     Post::create($attributes);
            
    //     return redirect('/');
    // }


}
