<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Sluggable;

    protected $table = 'categories';
    protected $fillable = ['name', 'uri', 'description', 'cover'];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'posts_categories');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
