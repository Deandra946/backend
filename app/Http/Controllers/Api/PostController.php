<?php

namespace App\Http\Controllers\Api;

use App\Models\Like;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function store(Request $request){


        $request->validate([
            "title" => "required",
            "image" => "required|image|mimes:png,jpg",
            "content" => "required"
        ]);

        $image = $request->file("image");
        $image->storeAs('img/post', $image->hashName());

        $post = Post::create([
            'title'=> $request->title,
            'image'=> $image->hashName(),
            'content'=> $request->content,
            'user_id' => Auth::id()
        ]);

        return response()->json([
            "message" => "Add post success",
            "post" => $post
        ]);
    }

    public function show($id){
        $post = Post::find($id);

        $like = Like::where('post_id', $post->id)->count();

        $comment = Comment::with('user')->where('post_id', $post->id)->get();
        return response()->json([
            "post"=> $post,
            "like" => $like,
            "comment" => $comment
        ]);
    }
}
