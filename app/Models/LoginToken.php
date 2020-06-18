<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
class LoginToken extends Model
{
    protected $fillable = [
        'user_id',
        'token'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
