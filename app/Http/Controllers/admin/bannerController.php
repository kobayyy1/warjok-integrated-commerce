<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        // Super admin bisa lihat semua banner
        if ($user->isSuperAdmin()) {
            $banners = Banner::with('store')->ordered()->paginate(10);
        } else {
            // Admin store hanya bisa lihat banner store mereka
            $banners = Banner::where('store_id', $user->store_id)
                ->ordered()
                ->paginate(10);
        }

        return view('admin.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->isSuperAdmin()) {
            $stores = Store::all();
        } else {
            $stores = Store::where('id', $user->store_id)->get();
        }

        return view('admin.banner.create', compact('stores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'store_id' => 'required|exists:stores,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
            'order' => 'nullable|integer|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        // Validasi: admin store hanya bisa create untuk store mereka
        if (!$user->isSuperAdmin() && $validated['store_id'] != $user->store_id) {
            abort(403, 'Unauthorized action.');
        }

        // Upload image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('banners', 'public');
            $validated['image'] = $imagePath;
        }

        Banner::create($validated);

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        $user = Auth::user();

        // Validasi akses
        if (!$user->isSuperAdmin() && $banner->store_id != $user->store_id) {
            abort(403, 'Unauthorized action.');
        }

        if ($user->isSuperAdmin()) {
            $stores = Store::all();
        } else {
            $stores = Store::where('id', $user->store_id)->get();
        }

        return view('admin.banner.edit', compact('banner', 'stores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $user = Auth::user();

        // Validasi akses
        if (!$user->isSuperAdmin() && $banner->store_id != $user->store_id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'store_id' => 'required|exists:stores,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
            'order' => 'nullable|integer|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        // Validasi: admin store tidak bisa pindah banner ke store lain
        if (!$user->isSuperAdmin() && $validated['store_id'] != $user->store_id) {
            abort(403, 'Unauthorized action.');
        }

        // Upload image baru jika ada
        if ($request->hasFile('image')) {
            // Hapus image lama
            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }

            $imagePath = $request->file('image')->store('banners', 'public');
            $validated['image'] = $imagePath;
        }

        $banner->update($validated);

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        $user = Auth::user();

        // Validasi akses
        if (!$user->isSuperAdmin() && $banner->store_id != $user->store_id) {
            abort(403, 'Unauthorized action.');
        }

        // Hapus image
        if ($banner->image) {
            Storage::disk('public')->delete($banner->image);
        }

        $banner->delete();

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner berhasil dihapus!');
    }

    /**
     * Toggle status banner
     */
    public function toggleStatus(Banner $banner)
    {
        $user = Auth::user();

        // Validasi akses
        if (!$user->isSuperAdmin() && $banner->store_id != $user->store_id) {
            abort(403, 'Unauthorized action.');
        }

        $banner->update([
            'status' => $banner->status === 'active' ? 'inactive' : 'active'
        ]);

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Status banner berhasil diubah!');
    }
}
