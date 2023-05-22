<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        // Validate the request data
        $request->validate([
            'content' => ['required', 'string'],
        ]);

        // Create a new comment
        $comment = new Comment();
        $comment->post_id = $postId;
        $comment->content = $request->content;
        $comment->save();

        // Return the created comment
        return response()->json($comment);
    }

    public function storeReply(Request $request, $commentId)
    {
        // Validate the request data
        $request->validate([
            'content' => ['required', 'string'],
        ]);

        // Find the parent comment
        $parentComment = Comment::findOrFail($commentId);

        // Create a new reply comment
        $reply = new Comment();
        $reply->post_id = $parentComment->post_id;
        $reply->parent_id = $parentComment->id;
        $reply->content = $request->content;
        $reply->save();

        // Return the created reply comment
        return response()->json($reply);
    }

    public function getCommentsForPost($postId)
    {
        // Fetch all comments for the post, including nested replies
        $comments = Comment::where('post_id', $postId)
            ->whereNull('parent_id')
            ->with('replies')
            ->get();

        // Return the comments
        return response()->json($comments);
    }
}
