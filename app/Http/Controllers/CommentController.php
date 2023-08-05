<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'content' => 'required',
            'post_id' => 'required'
        ]);
        $comment = new \App\Models\Comment;
        $comment->content = $request->content;
        $comment->post_id = $request->post_id;
        $comment->user_id = \Auth::user()->id;
        $comment->save();
        $parent_post = \App\Models\Post::find($request->post_id);
        return redirect('/post/' . $parent_post->slug);
    }
}
