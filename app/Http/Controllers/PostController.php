<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

class PostController extends Controller
{
    public function index()
    {
        return Post::with('user')->get();
    }

    public function destroy($post)
    {
        Post::destroy($post);
        return response()->json([
            'message' => 'Post successfully removed!'
        ]);
    }
}
