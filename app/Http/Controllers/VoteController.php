<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Vote;
use Auth;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function upvote(Request $request)
    {
        if (! Vote::where('user_id', Auth::user()->id)->where('post_id', $request->post_id)->first()) {
            $vote = new Vote;
            $vote->user_id = Auth::user()->id;
            $vote->post_id = $request->id;
            $vote->save();
        }

        $post = Post::find($request->id);

        return redirect('/post/'.$post->slug);
    }
}
