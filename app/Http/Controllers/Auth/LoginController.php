<?php

namespace App\Http\Controllers\Auth;

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
    $create = User::where('email', $user->email)->first();
    if($create==null){
        User::create($create);
        event(new Registered($create)); 
    }

    Auth::login($create);
    return redirect("http://localhost:3000");
    // Xử lý thông tin người dùng và đăng nhập vào ứng dụng Laravel
    // Ví dụ: kiểm tra xem người dùng đã tồn tại trong CSDL, sau đó tạo hoặc cập nhật thông tin.
    }
}
