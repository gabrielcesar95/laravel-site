<?php

namespace App\Models;

use App\Notifications\VerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use SoftDeletes;
    use HasRoles;
    use LogsActivity;
    use HasApiTokens;

    protected static $logAttributes = ['name', 'email', 'password', 'roles', 'permissions'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;
    protected static $logName = 'User';
    protected static $ignoreChangedAttributes = ['remember_token'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'provider_name', 'provider_id', 'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function providers()
    {
        return $this->hasMany(UserProvider::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function setActiveAttribute($param)
    {
        $this->attributes['active'] = $param ? 1 : 0;
    }

    public function getAvatarAttribute()
    {
        if (isset($this->attributes['avatar'])) {
            if (Str::startsWith($this->attributes['avatar'], ['http', 'https'])) {
                return $this->attributes['avatar'];
            }

            return url($this->attributes['avatar']);
        }

        return null;
    }
}
