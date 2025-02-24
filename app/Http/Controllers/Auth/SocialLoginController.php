<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;

class SocialLoginController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        
        // Create or update the user in the database and log them in
         // Check if the user exists, or create a new one
        // $existingUser = User::where('email', $user->getEmail())->first();

        // if ($existingUser) {
        //     Auth::login($existingUser);
        // } else {
        //     // If no user exists, create a new one
        //     $newUser = User::create([
        //         'name' => $user->getName(),
        //         'email' => $user->getEmail(),
        //         'password' => bcrypt(str_random(16)),  // You can customize this
        //     ]);
        //     Auth::login($newUser);
        // }
        return redirect()->route('home');
    }
}
