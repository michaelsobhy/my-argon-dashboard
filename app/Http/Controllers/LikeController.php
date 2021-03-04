<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }


    public function index()
    {
        $likes = Like::orderBy('created_at', 'desc')->with(['user', 'post'])->paginate(10);
        return view('tables.likes', [
            'likes' => $likes
        ]);
    }

    public function store(Post $post, Request $request)
    {
        $post->likes()->create([
            'user_id' => $request->user()->id
        ]);

        return back();
    }

    public function destroy(Like $like)
    {
        $this->authorize('delete', $like);

        $like->delete();

        return back();
    }
}
