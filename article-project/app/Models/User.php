<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_name',
        'account_name',
        'email',
        'email_verified_at',
        'password',
        'gender',
        'birth',
        'open_email',
        'site_url',
        'self_introduction',
        'remember_token',
        'is_delete',
        'onetime_token',
        'onetime_expiration',
        'why_quit',
        'quit_comment'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'onetime_token',
        'onetime_expiration'
    ];

    /**
     * The attributes that should be cast.
     * DBから取得した値を$castsで型変換する
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birthday' => 'date',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
