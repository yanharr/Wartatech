<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();            
            $finduser = User::where('google_id', $user->getId())->first();
            if($finduser){
                Auth::login($finduser);
                return redirect()->intended('/kreator');
            }else{
                $newUser = User::create([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'google_id' => $user->getId(),
                    'password' => bcrypt('12345678'),
                    'foto_profile' => $user->getAvatar()
                ]);

                Auth::login($newUser);
                return redirect()->intended('/kreator');
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
