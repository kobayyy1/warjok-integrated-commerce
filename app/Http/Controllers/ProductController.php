<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check.store.access');
    }

    public function index()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        if ($user->isSuperAdmin()) {
            $products = Product::with('store')
                ->when(request('store_id'), function ($query) {
                    $query->where('store_id', request('store_id'));
                })
                ->latest()
                ->paginate(10);
        } else {
            $products = Product::with('store')
                ->where('store_id', $user->store_id)
                ->latest()
                ->paginate(10);
        }

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        $stores = $user->isSuperAdmin()
            ? Store::all()
            : collect([$user->store]);

        return view('admin.products.create', compact('stores'));
    }

    public function store(Request $request)
{
    /** @var \App\Models\User $user */
    $user = auth()->user();

    $rules = [
        'name' => 'required|string|max:255',
        'sku' => 'required|string|unique:products,sku',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'status' => 'required|in:active,inactive',
    ];

    // ✅ Super admin wajib pilih store_id dari form
    if ($user->isSuperAdmin()) {
        $rules['store_id'] = 'required|exists:stores,id';
    }

    $validated = $request->validate($rules);

    // ✅ Admin biasa: otomatis gunakan store_id mereka
    if (!$user->isSuperAdmin()) {
        // Pastikan admin punya store_id
        if (!$user->store_id) {
            abort(403, 'Anda belum di-assign ke toko manapun. Hubungi super admin.');
        }
        $validated['store_id'] = $user->store_id;
    }

    // Handle image upload
    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('products', 'public');
    }

    Product::create($validated);

    return redirect()
        ->route('admin.products.index')
        ->with('success', 'Produk berhasil ditambahkan');
}
    
    public function show(Product $product)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        if (!$user->hasStoreAccess($product->store_id)) {
            abort(403, 'Anda tidak memiliki akses ke produk ini.');
        }

        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        if (!$user->hasStoreAccess($product->store_id)) {
            abort(403, 'Anda tidak memiliki akses ke produk ini.');
        }

        $stores = $user->isSuperAdmin()
            ? Store::all()
            : collect([$user->store]);

        return view('admin.products.edit', compact('product', 'stores'));
    }

    public function update(Request $request, Product $product)
    {
        // DEBUG: Log untuk melihat apakah method ini dipanggil
        Log::info('UPDATE METHOD CALLED', [
            'product_id' => $product->id,
            'request_data' => $request->all(),
            'request_method' => $request->method()
        ]);

        /** @var \App\Models\User $user */
        $user = auth()->user();

        if (!$user->hasStoreAccess($product->store_id)) {
            Log::error('ACCESS DENIED', ['user_id' => $user->id, 'product_store_id' => $product->store_id]);
            abort(403, 'Anda tidak memiliki akses ke produk ini.');
        }

        $rules = [
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku,' . $product->id,
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ];

        // Hanya super admin yang bisa mengubah store_id
        if ($user->isSuperAdmin()) {
            $rules['store_id'] = 'nullable|exists:stores,id';
        }

        try {
            $validated = $request->validate($rules);
            Log::info('VALIDATION PASSED', ['validated' => $validated]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('VALIDATION FAILED', ['errors' => $e->errors()]);
            throw $e;
        }

        // Set store_id untuk update (jika super admin)
        if ($user->isSuperAdmin() && $request->has('store_id')) {
            $validated['store_id'] = $request->input('store_id');
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);
        
        Log::info('PRODUCT UPDATED SUCCESSFULLY', ['product_id' => $product->id]);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Product $product)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        if (!$user->hasStoreAccess($product->store_id)) {
            abort(403, 'Anda tidak memiliki akses ke produk ini.');
        }

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus');
    }
}