<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name', 'uri', 'description', 'cover'];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'posts_categories');
    }
}
