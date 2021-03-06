<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }

    public function index()
    {
        $posts = Post::withTrashed()->orderBy('created_at', 'desc')->with(['user' => function($query) {
            $query->withTrashed();
        }, 'likes', 'comments'])->paginate(10);
        return view('tables.posts', [
            'posts' => $posts
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
        ]);

        $request->user()->posts()->create($request->only('body'));

        return back();
    }
    public function unpublish(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return back();
    }

    public function destroy($id)
    {
        $post = Post::withTrashed()->find($id);
        $this->authorize('delete', $post);

        $post->forceDelete();

        return back();
    }
}


//php artisan make:model -m -f to create a model, migration and factory
