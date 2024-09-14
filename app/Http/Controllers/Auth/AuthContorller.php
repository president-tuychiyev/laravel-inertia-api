<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthContorller extends Controller
{
    public function login()
    {
        $user = User::where('email', request()->login)->with('role')->first();

        if ($user) {
            if (Hash::check(request()->password, $user->password)) {
                Auth::login($user, request()->remember ?? false);

                return to_route('dashboard');
            }
            return back()->with('message', "The password was entered incorrectly");
        }
        return back()->with('message', "No such user exists");
    }

    public function logout()
    {
        Auth::logout();
        return to_route('login');
    }

    public function apiLogin()
    {
        $user = User::where('email', request()->login)->with('role')->first();

        if ($user) {
            if (Hash::check(request()->password, $user->password)) {
                Auth::login($user, request()->remember ?? false);

                return response()->json([
                    'user' => $user,
                    'token' => [
                        'type' => 'Bearer',
                        'value' => $user->createToken($user->email, [])->plainTextToken
                    ]
                ]);
            }
            return response()->json(['message' => "The password was entered incorrectly"]);
        }
        return response()->json(['message' => "No such user exists"]);
    }
}
