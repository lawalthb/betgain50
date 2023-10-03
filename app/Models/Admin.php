<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Message;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable {
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    use Notifiable;
    protected $guard = 'admin';
    protected $fillable = [
        'username',
        'email',
        'password',
        'phone_number',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    

}
