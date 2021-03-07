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
        $likes = Like::withTrashed()->orderBy('created_at', 'desc')->with(['user' => function($query) {
            $query->withTrashed();
        }, 'post'])->paginate(10);
        return view('tables.likes', [
            'likes' => $likes
        ]);
    }

    public function store(Post $post, Request $request)
    {
        $deletedLike = Like::onlyTrashed()->where('user_id', $request->user()->id)->where('post_id', $post->id);
        if ($deletedLike->count() === 0) {
            $post->likes()->create([
                'user_id' => $request->user()->id
            ]);
        } else {
            $deletedLike->restore();
        }

        return back();
    }

    public function publish($id)
    {
        $like = Like::withTrashed()->find($id);
        $this->authorize('restore', $like);

        $like->restore();

        return back();
    }

    public function unpublish(Like $like)
    {
        $this->authorize('delete', $like);

        $like->delete();

        return back();
    }

    public function destroy($id)
    {
        $like = Like::withTrashed()->find($id);
        $this->authorize('forceDelete', $like);

        $like->forceDelete();

        return back();
    }
}
