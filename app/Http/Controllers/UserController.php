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
}
