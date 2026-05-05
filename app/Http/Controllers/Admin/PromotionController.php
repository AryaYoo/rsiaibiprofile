<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::orderBy('order')->get();
        return view('admin.promotions.index', compact('promotions'));
    }

    public function create()
    {
        return view('admin.promotions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:5120',
            'background' => 'nullable|image|max:10240',
            'video' => 'nullable|mimes:mp4,webm,ogg|max:20480', // Max 20MB
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
        ]);

        $imagePath = $request->file('image')->store('promotions', 'public');
        $bgPath = $request->hasFile('background')
            ? $request->file('background')->store('promotions/bg', 'public')
            : null;
        $videoPath = $request->hasFile('video')
            ? $request->file('video')->store('promotions/videos', 'public')
            : null;

        Promotion::create([
            'image' => $imagePath,
            'background' => $bgPath,
            'video' => $videoPath,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'link' => $request->link,
            'is_active' => true,
        ]);

        return redirect()->route('admin.promotions.index')->with('success', 'Promosi berhasil ditambahkan.');
    }

    public function edit(Promotion $promotion)
    {
        return view('admin.promotions.edit', compact('promotion'));
    }

    public function update(Request $request, Promotion $promotion)
    {
        $request->validate([
            'image' => 'nullable|image|max:5120',
            'background' => 'nullable|image|max:10240',
            'video' => 'nullable|mimes:mp4,webm,ogg|max:20480',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($promotion->image);
            $promotion->image = $request->file('image')->store('promotions', 'public');
        }

        if ($request->hasFile('background')) {
            if ($promotion->background) {
                Storage::disk('public')->delete($promotion->background);
            }
            $promotion->background = $request->file('background')->store('promotions/bg', 'public');
        }

        if ($request->hasFile('video')) {
            if ($promotion->video) {
                Storage::disk('public')->delete($promotion->video);
            }
            $promotion->video = $request->file('video')->store('promotions/videos', 'public');
        }

        $promotion->title = $request->title;
        $promotion->subtitle = $request->subtitle;
        $promotion->link = $request->link;
        $promotion->save();

        return redirect()->route('admin.promotions.index')->with('success', 'Promosi berhasil diperbarui.');
    }

    public function destroy(Promotion $promotion)
    {
        Storage::disk('public')->delete($promotion->image);
        if ($promotion->background) {
            Storage::disk('public')->delete($promotion->background);
        }
        if ($promotion->video) {
            Storage::disk('public')->delete($promotion->video);
        }
        $promotion->delete();
        return redirect()->route('admin.promotions.index')->with('success', 'Promosi berhasil dihapus.');
    }

    public function toggle(Promotion $promotion)
    {
        $promotion->is_active = !$promotion->is_active;
        $promotion->save();
        return back()->with('success', 'Status promosi berhasil diubah.');
    }
}
