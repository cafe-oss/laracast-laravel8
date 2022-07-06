<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // need sya ma butngan ug comment and restart php artisan tinker
    // pwede pud guarded ganmiton pero opposite sya ug function
    // when using update() method, first is you need to specify what record you need to update
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     "title",
    //     "excerpt",
    //     "body",
    //     "slug",
    //     "category_id"
    // ];

    // kani ang alternative sa eager load, it assumes na pag tawagon nimo ang post sa route/controller kay muuban permi ang category ug author padulong sa view 
    protected $with =[
        'category',
        'author'
    ];

    use HasFactory;

    // route model binding
    // public function getRouteKeyName()
    // {
    //     return "slug";
    // }

    // eloquent relationship ep 24
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        //if the function name here is not equivalent to he model name, then it will have an error becuase laravel will assume the foreign id as function_name_id instead of your foreign id 
        // return $this->belongsTo(User::class);

        // solution to that problem is specify the foreign as parameter in belongsTo method
        return $this->belongsTo(User::class, "user_id");
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // create a postfilter ep38
    public function scopeFilter($query, array $filters)
    {
        // second approach of clean search
        // if($filters['search'])
        // {
        //     $query
        //         ->where('title', 'like', '%' . $filters['search'] . '%')
        //         ->orWhere('body', 'like', '%' . $filters['search'] . '%');
        // }

        //alternative of second approach of clean search
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where(function($query) use ($search){
                return $query->where('title', 'like', '%' . $search . '%')
                             ->orWhere('title', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['category'] ?? false, function($query, $category){
            return $query->whereExists(function($query) use ($category){
                            return $query->from('categories')
                                         ->whereColumn('categories.id', 'posts.category_id')
                                         ->where('categories.slug', $category);
                        });

        });

        //alternative of second approach of clean search and same with "where exists"
        $query->when($filters['author'] ?? false, function($query, $author){
            return $query->whereHas('author', function($query) use($author){
                return $query->where('username', $author);
            });

        });
    }

}
