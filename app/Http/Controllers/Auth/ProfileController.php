<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use romanzipp\Twitch\Twitch;
use romanzipp\Twitch\Enums\GrantType;

class ProfileController extends Controller
{
    public function store(Request $request): Response
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
        ]);

        $user = User::where("email","=",$request->email)->first();

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;

        $user->save();

        return response()->noContent();
    }
    public function editpass(Request $request): Response
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::where("email","=",$request->email)->first();

        $user->password = Hash::make($request->password);

        $user->save();

        return response()->noContent();
    }
    public function getvideo(Request $request): Response{
        $twitch = new Twitch;

        $twitch->setClientId('8sqhlarka9oxunw13cqe20jncim7n0');
        $twitch->setClientSecret('xkjb4i26bi23o68u0emh1zq6hawzib');
        // Get User by Username
        $result = $twitch->getOAuthToken(null, GrantType::CLIENT_CREDENTIALS);
        $accessToken = $result->data()->access_token;
        //dd($accessToken);
        $user = $twitch->getUsers(['login' => $request->username]);
        $userid= $user->data()[0]->id;
        $videos = $twitch->getVideos(['user_id' => $userid]);
        for ($i = 0; $i<count($videos->data())-1;$i++ ){
            for($j = 0; $j < count($videos->data())- $i - 1; $j++ ){
                if($videos->data()[$j]->view_count < $videos->data()[$j+1]->view_count){
                    $tg = $videos->data()[$j]->id;
                    $videos->data()[$j]->id=$videos->data()[$j+1]->id;
                    $videos->data()[$j+1]->id=$tg;
                    $tg = $videos->data()[$j]->view_count;
                    $videos->data()[$j]->view_count=$videos->data()[$j+1]->view_count;
                    $videos->data()[$j+1]->view_count=$tg;
                }
            }
        }
    
        for ($i = 0; $i< 5;$i++ ){
            $videosid[$i] = $videos->data()[$i]->id;
        }
        return response($videosid);
    }
}
