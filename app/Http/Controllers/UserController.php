<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function destroy($user)
    {
        User::destroy($user);
        return response()->json([
            'message' => 'User successfully removed!'
        ]);
    }

    public function edit($user)
    {
        $user = User::find($user);
        $user->name = request('user.name');
        $user->username = request('user.username');
        $user->email = request('user.email');
        $user->password = md5(request('user.password'));
        $user->save();
        return response()->json([
            'message' => 'User successfully edited!'
        ]);
    }

    public function create()
    {
        $data = request()->user;
        $user = new User($data);
        $user->save();
        return response()->json([
            'user' => $user,
            'message' => 'User Successfully added!'
        ]);
    }
}
