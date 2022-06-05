<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;


class Post{


    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug;

    public function __construct($title, $excerpt, $date, $body, $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    public static function all(){
        // first method
        // file facade it allows usage of static access of all sorts of functionality
        $files = File::files(resource_path("posts/"));

        //using collect instead of map array

        // array map is like a loop and return a list 
        // return array_map(function ($file){
        //     return $file->getContents();
        // }, $files);

        // second method with cache rememberForever
        return cache()->rememberForever('post.all', function() use ($files){
            return collect($files)
                ->map(function($file){
                    return YamlFrontMatter::parseFile($file);
                })
                ->map(function($documents){
                    return new Post(
                        $documents->title,
                        $documents->excerpt,
                        $documents->date,
                        $documents->body(),
                        $documents->slug
                    );
                })
                // or you can ->sortBy('Date', SORT_REGULAR, true);
                ->sortByDesc('date');
        });
    }

    public static function find($slug){

        // first method 
        // instead of this $path = __DIR__ . "/../resources/{$slug}.html";
        // $path = resource_path("posts/{$slug}.html");

        // if (! file_exists($path)){
        //     // instead return redirect('/');
        //     return new ModelNotFoundException();
        // }

        // it allows effective usage of expensive operation by storing in the memory
        // time now()->addMinutes(30);
        // try ni unya function($slug) tas walaon ang use ($path)
        // return cache()->remember("posts.{$slug}", 5, function () use ($path){
        //     return file_get_contents($path);
        // });

        // second method 
        // $posts = static::all();
        // return $posts->firstWhere('slug', $slug);

        // third method slug na naa sa Post object equivalent ba sa gehatag sa slug
        $post = static::all()->firstWhere('slug', $slug);

        if(! $post)
        {
            throw new ModelNotFoundException;
        }

        return $post;
    }
}