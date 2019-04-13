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

    public function edit($post)
    {
        $post = Post::find($post);
        $post->title = request('post.title');
        $post->description = request('post.description');
        $post->user_id = request('post.user_id');
        $post->save();
        return response()->json([
            'message' => 'Post successfully edited!'
        ]);
    }

    public function create()
    {
        $data = request()->post;
        $post = new Post($data);
        $post->save();
        return response()->json([
            'message' => 'Post Successfully added!'
        ]);
    }
}
