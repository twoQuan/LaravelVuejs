<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index () {
        $users = User::where('twitch','=','1')->get();
        return $users;
    }
}
