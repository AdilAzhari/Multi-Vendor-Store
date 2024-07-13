<?php

namespace App\Actions\Fortify;

use App\Models\admin;
use Illuminate\Support\Facades\Hash;

class Authenticateuser
{
    /**
     * Validate and authenticate the user.
     *
     * @param  array<string, string>  $input
     * @return void
     */
    public function authenticate($request)
    {
        $username = $request->post(config('fortify.username'));
        $password = $request->post('password');

        $user = admin::where('username', $username)->orWhere('email', $username)
        ->orWhere('phone_number', $username)->first();

        if ($user && Hash::check($password, $user->password)) {
            return $user;
        }


    }
}
