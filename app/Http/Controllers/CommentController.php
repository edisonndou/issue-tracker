<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Issue;
use App\Http\Requests\StoreCommentRequest;

class CommentController extends Controller
{
    //----------
    public function store(StoreCommentRequest $request, Issue $issue)
    {
        $comment = $issue->comments()->create($request->validated());

        if ($request->expectsJson()) {
            return response()->json([
                'comment' => $comment,
                'message' => 'Comment added!',
            ]);
        }

        return back()->with('success', 'Comment added!');
    }
    //----------
    public function destroy(Comment $comment)
    {
        $issue = $comment->issue;
        $project = $issue->project;
        $comment->delete();

        if (request()->wantsJson()) {
            return response()->json(['message' => 'Comment deleted!']);
        }

        return back()->with('success', 'Comment deleted!');
    }
}

