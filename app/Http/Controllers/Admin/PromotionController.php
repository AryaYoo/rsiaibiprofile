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
            'image' => 'required|image|mimes:jpeg,jpg,png,webp,gif,svg|max:5120',
            'background' => 'nullable|image|mimes:jpeg,jpg,png,webp,gif,svg|max:10240',
            'video' => 'nullable|mimes:mp4,webm,ogg|max:20480',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
        ], [
            'image.required' => 'File gambar promosi (slider) wajib dipilih.',
            'image.image' => 'File promosi harus berupa format gambar yang valid.',
            'image.mimes' => 'Format gambar yang diperbolehkan: JPG, PNG, WEBP, GIF, SVG.',
            'image.max' => 'Ukuran gambar promosi terlalu besar! Maksimal ukuran adalah 5 MB.',
            'background.image' => 'File background hero harus berupa gambar yang valid.',
            'background.mimes' => 'Format background hero yang diperbolehkan: JPG, PNG, WEBP, GIF, SVG.',
            'background.max' => 'Ukuran background hero terlalu besar! Maksimal ukuran adalah 10 MB.',
            'video.mimes' => 'Format video loop harus berformat MP4, WEBM, atau OGG.',
            'video.max' => 'Ukuran file video loop terlalu besar! Maksimal ukuran adalah 20 MB.',
        ]);

        try {
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

            return redirect()->route('admin.promotions.index')->with('success', 'Promosi baru telah berhasil disimpan dan siap ditampilkan di website!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menyimpan promosi: ' . $e->getMessage());
        }
    }

    public function edit(Promotion $promotion)
    {
        return view('admin.promotions.edit', compact('promotion'));
    }

    public function update(Request $request, Promotion $promotion)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp,gif,svg|max:5120',
            'background' => 'nullable|image|mimes:jpeg,jpg,png,webp,gif,svg|max:10240',
            'video' => 'nullable|mimes:mp4,webm,ogg|max:20480',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
        ], [
            'image.image' => 'File promosi harus berupa format gambar yang valid.',
            'image.mimes' => 'Format gambar yang diperbolehkan: JPG, PNG, WEBP, GIF, SVG.',
            'image.max' => 'Ukuran gambar promosi terlalu besar! Maksimal ukuran adalah 5 MB.',
            'background.image' => 'File background hero harus berupa gambar yang valid.',
            'background.mimes' => 'Format background hero yang diperbolehkan: JPG, PNG, WEBP, GIF, SVG.',
            'background.max' => 'Ukuran background hero terlalu besar! Maksimal ukuran adalah 10 MB.',
            'video.mimes' => 'Format video loop harus berformat MP4, WEBM, atau OGG.',
            'video.max' => 'Ukuran file video loop terlalu besar! Maksimal ukuran adalah 20 MB.',
        ]);

        try {
            if ($request->hasFile('image')) {
                if ($promotion->image) {
                    Storage::disk('public')->delete($promotion->image);
                }
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

            return redirect()->route('admin.promotions.index')->with('success', 'Data promosi telah berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal mengupdate promosi: ' . $e->getMessage());
        }
    }

    public function destroy(Promotion $promotion)
    {
        try {
            if ($promotion->image) {
                Storage::disk('public')->delete($promotion->image);
            }
            if ($promotion->background) {
                Storage::disk('public')->delete($promotion->background);
            }
            if ($promotion->video) {
                Storage::disk('public')->delete($promotion->video);
            }
            $promotion->delete();
            return redirect()->route('admin.promotions.index')->with('success', 'Promosi berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus promosi: ' . $e->getMessage());
        }
    }

    public function toggle(Promotion $promotion)
    {
        try {
            $promotion->is_active = !$promotion->is_active;
            $promotion->save();
            $statusText = $promotion->is_active ? 'diaktifkan' : 'dinonaktifkan';
            return back()->with('success', "Status promosi berhasil {$statusText}.");
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengubah status promosi: ' . $e->getMessage());
        }
    }
}
