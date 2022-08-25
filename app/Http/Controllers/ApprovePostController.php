<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;

class ApprovePostController extends Controller
{
    public function __invoke(Post $post): View
    {
        $post->approved_at = now();
        $post->approved_by = auth()->user()->id;
        $post->save();

        return view('posts.show',['post'=> $post]);
    }
}
