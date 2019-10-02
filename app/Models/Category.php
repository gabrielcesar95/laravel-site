<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use Sluggable;
    use SoftDeletes;
    use LogsActivity;

    protected static $logAttributes = ['name', 'description', 'cover'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;
    protected static $logName = 'Category';

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
