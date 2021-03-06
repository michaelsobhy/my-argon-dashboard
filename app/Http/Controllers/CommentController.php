<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['store', 'destroy', 'unpublish']);
    }


    public function index()
    {
        $comments = Comment::withTrashed()->orderBy('created_at', 'desc')->with(['user' => function($query) {
            $query->withTrashed();
        }, 'post'])->paginate(10);
        return view('tables.comments', [
            'comments' => $comments
        ]);
    }

    public function store(Post $post, Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
        ]);

        $post->comments()->create([
            'body' => $request->body,
            'post_id' => $post->id,
            'user_id' => $request->user()->id
        ]);

        return back();
    }

    public function unpublish(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return back();
    }

    public function destroy($id)
    {
        $comment = Comment::withTrashed()->find($id);
        $this->authorize('delete', $comment);

        $comment->forceDelete();

        return back();
    }
}
