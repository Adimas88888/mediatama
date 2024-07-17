<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VideoRequest;
use App\Models\User;
use App\Models\Video;

class VideoRequestController extends Controller
{
    public function index()
    {
        // Ambil semua permintaan akses video
        $videoRequests = VideoRequest::all();

        // Kirim data ke view video_requests.blade.php
        return view('video_requests.index', compact('videoRequests'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'video_id' => 'required|exists:videos,id',
        ]);

        // Buat permintaan akses video baru
        VideoRequest::create([
            'user_id' => $request->user_id,
            'video_id' => $request->video_id,
            'status' => 'pending',
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Permintaan akses video berhasil dikirim.');
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        // Temukan permintaan akses video berdasarkan ID
        $videoRequest = VideoRequest::findOrFail($id);

        // Update status permintaan akses video
        $videoRequest->status = $request->status;
        $videoRequest->save();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Status permintaan akses video berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Temukan dan hapus permintaan akses video berdasarkan ID
        $videoRequest = VideoRequest::findOrFail($id);
        $videoRequest->delete();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Permintaan akses video berhasil dihapus.');
    }
}
