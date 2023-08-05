<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function list() {
        return view('index', [
            'posts' => \App\Models\Post::all()
        ]);
    }
    public function create () {
        return view('create_post');
    }

    // post method for creating a post
    public function store(Request $request) {
        $request->validate([
            'title' => 'nullable',
            'syndicated_post_url' => 'required',
            'content' => 'nullable'
        ]);

        // if no title, load HTML of syndicated_post_url
        if (!$request->title) {
            $webpage = Http::get($request->syndicated_post_url);
            $title = $webpage->html()->find('title') ?? $request->syndicated_post_url;
            $request->title = $title[0]->text();
        }

        $post = new \App\Models\Post;
        $post->title = $request->title;
        // set user_id
        $post->user_id = \Auth::user()->id;
        $post->syndicated_post_url = $request->syndicated_post_url;
        $post->content = $request->content;
        $post->slug = \Str::slug($request->title);
        $post->save();
        return redirect('/post/' . $post->slug);
    }

    public function show(string $slug) {
        return view('post', [
            'post' => \App\Models\Post::where('slug', $slug)->firstOrFail()
        ]);
    }
}
