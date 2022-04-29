<?php

namespace App\Http\Controllers\Api;

use DB;
use Auth;
use App\Models\Tag;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::with('tags')->get();

        return response()->json(['posts' => $posts]);
    }

    public function store(PostRequest $request)
    {
        DB::transaction(function () use ($request) {
            // $tags = array();

            $post = new Post;
            $post->user_id = Auth::id();
            $post->title = $request->title;

            if($request->has('extract') 
                && !empty($request->extract)){
                $post->extract = $request->extract;
            }

            $post->content = $request->content;
            $post->save();

            foreach ($request->tags as $key => $value) {
                $tag = Tag::firstOrCreate(['name' => $value]);
                // array_push($tags,$tag->id);
                $post->tags()->attach($tag->id);
            }

            // $post->tags()->attach($tags);
        });

        return response()->json(['message' => 'Post guardado correctamente']);
    }
}
