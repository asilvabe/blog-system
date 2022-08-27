<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Post;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::simplePaginate(3);

        return view('posts.index', compact('posts'));
    }

    public function create(): View
    {
        return view('posts.create');
    }

    public function show(Post $post): View
    {
        return view('posts.show', ['post'=> $post]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'min:1', 'max:30'],
            'body' => ['required', 'max:250'],
        ]);

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->created_by = auth()->user()->id;

        $post->save();

        session()->flash('status', 'Post Created!!');

        return to_route('posts.index');
    }
}
