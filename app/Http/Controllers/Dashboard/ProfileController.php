<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateproductRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use Symfony\Component\Intl\Countries;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        $countries = Countries::getNames('ar');
        return view('dashboard.profile.edit', compact('user', 'countries'));
    }
    public function update(UpdateProfileRequest $request)
    {
        $user = auth()->user();

        $user->profile->update($request->validated());

        return back()->with('success', 'Profile updated successfully');
    }
}
