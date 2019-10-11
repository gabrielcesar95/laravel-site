<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProvider extends Model
{
    protected $table = 'users_providers';
    protected $fillable = ['user_id', 'token', 'refresh_token', 'provider_name', 'provider_id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
