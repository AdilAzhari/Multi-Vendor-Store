<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'street_address',
        'city',
        'state',
        'country',
        'locale',
        'postal_code',
        'date_of_birth',
        'gender',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
