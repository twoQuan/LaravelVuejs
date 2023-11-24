<?php

namespace App\Http\Controllers\Auth;

use DB;
use Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function redirectToTwitch()
    {
        return Socialite::driver('twitch')->redirect();
    }
    public function handleTwitchCallback()
    {
    $user = Socialite::driver('twitch')->user();
    $check = User::where('email', $user->email)->first();
    if($check==null){
        $create = ([
            'name' => $user->name,
            'email' => $user->email,
            'password' => Hash::make('123456'),
            'twitch' => 1,
        ]);
        DB::table('users')->insert($create);
        $check = User::where('email', $user->email)->first();
        Auth::login($check);
    }
    else{
        Auth::login($check);
    }
    return redirect("http://localhost:3000/");
    }
}
