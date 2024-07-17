<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        
        $videos = Video::all();
        return view('admin.crud', compact('videos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'videoName' => 'required',
            'videoLink' => 'required|url',
            'videoDuration' => 'required|integer'
        ]);

        Video::create([
            'name' => $request->videoName,
            'link' => $request->videoLink,
            'duration' => $request->videoDuration
        ]);

        return redirect()->route('crud');
    }

    public function edit(Video $video)
    {
        return view('admin.edit', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'videoName' => 'required',
            'videoLink' => 'required|url',
            'videoDuration' => 'required|integer'
        ]);

        $video->update([
            'name' => $request->videoName,
            'link' => $request->videoLink,
            'duration' => $request->videoDuration
        ]);

        return redirect()->route('crud');
    }

    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('crud');
    }
}
