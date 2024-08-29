<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index()
    {
        return PostResource::collection(Post::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'body' => 'required|string',
        ]);
        $post = Post::create($validated);
        return new PostResource($post);
    }

    public function show(Post $post)
    {
        return new PostResource($post);
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'body' => 'required|string',
        ]);
        $post->update($validated);
        return new PostResource($post);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->noContent();
    }

    public function userPosts(int $userId)
    {
        $posts = Post::where('user_id', $userId)->get();
        return PostResource::collection($posts);
    }
}