<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponses;
use Faker\Provider\ar_EG\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AccessTokensController extends Controller
{
    use ApiResponses;
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
            'abilities' => 'nullable|array'
        ]);

        $user = User::where('email', '=', $request->post('email'))->first();
        if ($user && Hash::check($request->password, $user->password)) {
            // Create Access Token and return it in response
            $token = $user->createToken( $request->userAgent(), [
                'products.create', 'products.read'
            ]);
            return $this->successResponse(['token' => $token->plainTextToken,'user' => $user], 'Token Generated Successfully', 201);
        }

        return $this->errorResponse('Invalid credentials', 401);

    }
    public function destroy($token = null)
    {
        $user = auth()->user();
        if($token === null){
            $user->currentAccessToken()->delete();
            return $this->successResponse('Logout Successful', 204);
        }
        $PersonalAccessToken = PersonalAccessToken::findToken($token);
        if(!$PersonalAccessToken){
            return $this->errorResponse('Invalid Token', 404);
        }
        if($user->id == $PersonalAccessToken->tokenable_id && $PersonalAccessToken->tokenable_type == User::class){
            $PersonalAccessToken->delete();
            return $this->destroyResponse('Logout Successful', 204);
        }
        return $this->errorResponse('Invalid Token', 404);
    }
}
