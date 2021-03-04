<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }


    public function index()
    {
        $comments = Comment::orderBy('created_at', 'desc')->with(['user', 'post'])->paginate(10);
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

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return back();
    }
}
