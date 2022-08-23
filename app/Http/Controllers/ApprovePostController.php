<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;

class ApprovePostController extends Controller
{
    public function __invoke(Post $post): view
    {
        $post->approved_at=Carbon::now();
        $post->approved_by=auth()->user()->id;
        $post->save();

        return view('posts.show',['post'=> $post]);
    }
}
