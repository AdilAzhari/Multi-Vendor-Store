<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;

class admin extends User
{
    use HasFactory,Notifiable,TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'username',
        'phone_number',
        'super_admin',
        'status',
        'password'
    ];

    protected $hidden = ['password'];
}
