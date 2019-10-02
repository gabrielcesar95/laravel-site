<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Post extends Model
{
    use Sluggable;
    use SoftDeletes;
    use LogsActivity;

    protected static $logAttributes = ['user_id', 'name', 'subtitle', 'content', 'cover', 'posted_at'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;
    protected static $logName = 'Post';

    protected $table = 'posts';
    protected $fillable = ['user_id', 'name', 'subtitle', 'content', 'cover', 'posted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'posts_categories');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getPostedAtAttribute($value)
    {
        if (!$value) {
            return null;
        }

        $datetime = new \DateTime($value);
        return $datetime->format('d/m/Y H:i');
    }

    public function setPostedAtAttribute($value)
    {
        if ($value) {
            $datetime = \DateTime::createFromFormat('d/m/Y H:i', $value);
            $this->attributes['posted_at'] = $datetime->format('Y-m-d H:i');
        } else {
            $this->attributes['posted_at'] = null;
        }

    }

}
