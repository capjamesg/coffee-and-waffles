<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    public function list()
    {
        // order by vote count, get comment count too
        $posts_votes_comments = \App\Models\Post::withCount(['votes', 'comments'])->orderBy('votes_count', 'desc')->get();

        return view('index', [
            'posts' => $posts_votes_comments,
            'postsByUser' => false,
        ]);
    }

    public function newest()
    {
        // get posts w/ vote count, ordered by created_at
        $posts_votes_comments = \App\Models\Post::withCount(['votes', 'comments'])->orderBy('created_at', 'desc')->get();

        return view('index', [
            'posts' => $posts_votes_comments,
            'postsByUser' => false,
        ]);
    }

    public function create()
    {
        return view('create_post');
    }

    public function receiveWebmention(Request $request)
    {
        $post_body = $request->json('post');
        // $title = $post['name'];
        // if wm-property is like-of, create upvote from user 1
        if ($post_body['wm-property'] == 'like-of') {
            $post = new \App\Models\Post;
            $post->title = $title;
            $post->syndicated_post_url = $post_body['url'];
            $post->user_id = 1;
            $post->slug = \Str::slug($title);
            $post->save();

            $vote = new \App\Models\Vote;
            $vote->user_id = 1;
            $vote->post_id = $post->id;
            $vote->save();

            return response('OK', 200);
        }

        // if u-reply-to, create content
        if ($post_body['wm-property'] == 'in-reply-to') {
            $comment = new \App\Models\Comment;
            $comment->post_id = \App\Models\Post::where('syndicated_post_url', $request->json('wm-target'))->first()->id;
            $comment->user_id = 1;
            $comment->content = $request->json('content');
            $comment->save();

            return response('OK', 200);
        }

        // if not bookmark of set, return 400
        if (! isset($post_body['bookmark-of'])) {
            return response('Bad Request', 400);
        }

        $syndicated_post_url = $post_body['bookmark-of'];

        $post = new \App\Models\Post;

        // if name key doesn't exist, get
        if (! isset($post_body->name)) {
            $response = Http::get($syndicated_post_url);
            $html = $response->getBody()->getContents();

            $dom = new \DOMDocument();
            libxml_use_internal_errors(true); // Disable HTML5 validation errors
            $dom->loadHTML($html);
            libxml_clear_errors();

            $titleElement = $dom->getElementsByTagName('title')->item(0);
            $title = $titleElement->textContent;
        } else {
            $title = $post_body->name;
        }

        $post->title = $title;
        $post->syndicated_post_url = $syndicated_post_url;

        // if user not signed in
        if (! \Auth::user()) {
            // use "webmention" reserved user
            $post->user_id = 1;
        } else {
            // set user_id
            $post->user_id = \Auth::user()->id;
        }

        $post->slug = \Str::slug($title);
        $post->content = '';
        $post->save();

        return response('OK', 200);
    }

    // post method for creating a post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable',
            'syndicated_post_url' => 'required',
            'content' => 'nullable',
        ]);

        // if no title, load HTML of syndicated_post_url
        if (! $request->title) {
            $webpage = Http::get($request->syndicated_post_url)->getBody()->getContents();
            $title = $webpage->find('title');
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

        return redirect('/post/'.$post->slug);
    }

    public function show(string $slug)
    {
        $comments = \App\Models\Comment::where('post_id', \App\Models\Post::where('slug', $slug)->first()->id)->get();

        return view('post', [
            'post' => \App\Models\Post::withCount('votes')->where('slug', $slug)->first(),
            'comments' => $comments,
        ]);
    }

    public function delete(string $slug)
    {
        if (\Auth::user()->is_admin) {
            // delete post
            $post = \App\Models\Post::where('slug', $slug)->first();
            $post->delete();
        }

        return redirect('/');
    }
}
