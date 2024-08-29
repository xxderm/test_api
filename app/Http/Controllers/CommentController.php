<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;

class CommentController extends Controller
{
    public function index()
    {
        return CommentResource::collection(Comment::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'user_id' => 'required|exists:users,id',
            'body' => 'required|string',
        ]);
        $comment = Comment::create($validated);
        return new CommentResource($comment);
    }

    public function show(Comment $comment)
    {
        return new CommentResource($comment);
    }

    public function update(Request $request, Comment $comment)
    {
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'user_id' => 'required|exists:users,id',
            'body' => 'required|string',
        ]);
        $comment->update($validated);
        return new CommentResource($comment);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->noContent();
    }

    public function userComments(int $userId)
    {
        $comments = Comment::where('user_id', $userId)->get();
        return CommentResource::collection($comments);
    }

    public function postComments(int $postId)
    {
        $comments = Comment::where('post_id', $postId)->get();
        return CommentResource::collection($comments);
    }
}