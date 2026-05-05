<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InstagramPost;
use Illuminate\Http\Request;

class InstagramPostController extends Controller
{
    public function index()
    {
        $posts = InstagramPost::latest()->paginate(10);
        return view('admin.instagram.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'post_url' => 'required|url',
        ]);

        InstagramPost::create([
            'post_url' => $request->post_url,
            'is_active' => true,
        ]);

        return redirect()->back()->with('success', 'Post Instagram berhasil ditambahkan!');
    }

    public function update(Request $request, InstagramPost $instagram)
    {
        $instagram->update([
            'is_active' => !$instagram->is_active
        ]);

        return redirect()->back()->with('success', 'Status post berhasil diperbarui!');
    }

    public function destroy(InstagramPost $instagram)
    {
        $instagram->delete();
        return redirect()->back()->with('success', 'Post Instagram berhasil dihapus!');
    }
}
