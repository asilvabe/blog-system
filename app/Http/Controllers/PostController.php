<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Post;
use App\Models\User;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(Request $request): View
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            return view('posts.index', [
                'posts' => [],
                'users' => [],
            ]);
        }

        $posts = Post::title($request->get('title_search'))
        ->status($request->get('status'))
        ->author($request->get('author'))
        ->daterange($request->get('date_from'), $request->get('date_to'))
        ->paginate(19)
        ->withQueryString();

        $users = User::all();

        return view('posts.index', compact('posts', 'users'));
    }

    public function create(): View
    {
        return view('posts.create');
    }

    public function show(Post $post): View
    {
        return view('posts.show', ['post' => $post]);
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

        return to_route('welcome');
    }
}
