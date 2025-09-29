<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    // Google Login
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Google Callback
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'password' => Hash::make(Str::random(24)),
                'email_verified_at' => now(),
            ]
        );

        Auth::login($user, true);

        return redirect('/')->with('success', 'Connecté avec Google!');
    }

    // GitHub Login
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    // GitHub Callback
    public function handleGithubCallback()
    {
        $githubUser = Socialite::driver('github')->user();

        $user = User::firstOrCreate(
            ['email' => $githubUser->getEmail()],
            [
                'name' => $githubUser->getName() ?? $githubUser->getNickname(),
                'password' => Hash::make(Str::random(24)),
                'email_verified_at' => now(),
            ]
        );

        Auth::login($user, true);

        return redirect('/')->with('success', 'Connecté avec GitHub!');
    }
}
