<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $user = Auth::user();

        $request->validate([
            'comment' => 'required|string'
        ]);


        $comment = Comment::create([
            'user_id' => $user->id,
            'post_id' => $postId,
            'comment' => $request->comment
        ]);

        return response()->json([
            "message" => "Comment success",
            "comment" => $comment
        ]);
    }

    public function destroy($postId){
        $user = Auth::user();

        $comment = $user->comment()->where('post_id', $postId)->first();

        if (!$comment) {
            return response()->json([
                "message" => "You haven't commentd this post yet"
            ]);
        }

        $comment->delete();

        return response()->json([
            "message" => "delete comment successs"
        ]);
    }
}
