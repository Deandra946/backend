<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Request $request, $postId)
    {
        $user = Auth::user();

        if ($user->like()->where('post_id', $postId)->exists()) {
            return response()->json([
                "message" => "You alrady like this post"
            ]);
        }

        $user->like()->create([
            "post_id" => $postId,
            "user_id" => $user->id,
            "like" => 1
        ]);

        return response()->json([
            "message" => "like success"
        ]);
    }

    public function unlike(Request $request, $postId)
    {
        $user = Auth::user();
        
        $like = $user->like()->where('post_id', $postId)->first();

        if (!$like) {
            return response()->json([
                "message" => "You haven't liked this post yet"
            ]);
        }

        $like->delete();

        return response()->json([
            "message" => "Unlike success"
        ]);
    }
}
