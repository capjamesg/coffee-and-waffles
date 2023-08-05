<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VoteController extends Controller
{
    function upvote(Request $request) {
        if (!\App\Models\Vote::where('user_id', \Auth::user()->id)->where('post_id', $request->post_id)->first()) {
            $vote = new \App\Models\Vote;
            $vote->user_id = \Auth::user()->id;
            $vote->post_id = $request->id;
            $vote->save();
        }

        $post = \App\Models\Post::find($request->id);

        return redirect('/post/' . $post->slug);
    }
}
