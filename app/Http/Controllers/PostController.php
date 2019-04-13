<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->get();
        $users = User::all();
        return response()->json([
            'posts' => $posts,
            'users' => $users
        ]);
    }

    public function destroy($post)
    {
        Post::destroy($post);
        return response()->json([
            'message' => 'Post successfully removed!'
        ]);
    }
}
