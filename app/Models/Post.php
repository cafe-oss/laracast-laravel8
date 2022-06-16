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
    protected $fillable = [
        "title",
        "excerpt",
        "body"
    ];

    use HasFactory;

}
