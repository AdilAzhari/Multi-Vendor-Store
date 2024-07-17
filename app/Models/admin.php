<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Model
{
    use HasFactory,Notifiable,TwoFactorAuthenticatable,HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'username',
        'phone_number',
        'super_admin',
        'status',
        'password'
    ];

}
