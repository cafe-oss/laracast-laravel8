<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

class Post{

    public static function all(){
        // file facade it allows usage of static access of all sorts of functionality
        $files = File::files(resource_path("posts/"));

        // array map is like a loop and return a list 
        return array_map(function ($file){
            return $file->getContents();
        }, $files);
    }

    public static function find($slug){
        // instead of this $path = __DIR__ . "/../resources/{$slug}.html";
        $path = resource_path("posts/{$slug}.html");

        if (! file_exists($path)){
            // instead return redirect('/');
            return new ModelNotFoundException();
        }

        // it allows effective usage of expensive operation by storing in the memory
        // time now()->addMinutes(30);
        // try ni unya function($slug) tas walaon ang use ($path)
        return cache()->remember("posts.{$slug}", 5, function () use ($path){
            return file_get_contents($path);
        });
    }
}