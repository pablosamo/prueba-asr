<?php

namespace App\Http\Controllers\Api;

use DB;
use Auth;
use App\Models\Tag;
use App\Models\Video;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\VideoRequest;

class VideosController extends Controller
{
    public function index()
    {
        $videos = Video::with('tags')->get();

        return response()->json(['videos' => $videos]);
    }

    public function store(VideoRequest $request)
    {
        DB::transaction(function () use ($request) {
            $tags = array();

            $video = new Video;
            $video->user_id = Auth::id();
            $video->title = $request->title;
            $video->save();

            foreach ($request->tags as $key => $value) {
                $tag = Tag::firstOrCreate(['name' => $value]);
                array_push($tags,$tag->id);
            }

            $video->tags()->attach($tags);
        });

        return response()->json(['message' => 'Vídeo guardado correctamente']);
    }
}
