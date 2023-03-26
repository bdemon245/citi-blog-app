<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    /**
     * Redirects every request from a given provider
     * 
     */
    public function redirectToProvider(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleCallback($provider)
    {

        $user = Socialite::driver($provider)->stateless()->user();

        $newUser = User::updateOrCreate(
            [
                'email' => $user->email,
            ],
            [
                'email' => $user->email,
                'name' => $user->name,
                'avatar' => $user->avatar,
            ]
        );
        Auth::login($newUser);
        if (!auth()->user()->hasRole('user')) {
            auth()->user()->assignRole('user');
        }
        // dd(auth()->user());
        return redirect('/')->with('success', "Log in success");
    }
}
