<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;

class ApprovePostController extends Controller
{
    public function __invoke(Post $post): RedirectResponse
    {
        $post->approved_at = now();
        $post->approved_by = auth()->user()->id;
        $post->save();

        return to_route('posts.show', $post);
    }
}
