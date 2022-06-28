<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;

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
        return view('posts', [
            
            'posts' => Post::latest("published_at")->with(['category', 'author'])->filter(request(['search']))->get(),
            'categories' => Category::all()
            
        ]);
    }

    public function show(Post $post)
    {

        return view('post', [

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


}
