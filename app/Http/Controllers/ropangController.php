<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Banner;
use App\Models\Store;
use Illuminate\Http\Request;

class RopangController extends Controller
{
    public function ropang()
    {
        // Ambil store Ropang
        $store = Store::where('name', 'LIKE', '%Ropang%')->first();
        
        // Jika tidak ditemukan, coba dengan ID store Ropang
        if (!$store) {
            $store = Store::find(3); // ID store Ropang
        }
        
        $storeId = $store ? $store->id : 3;
        
        // Ambil produk dari store Ropang yang aktif
        $products = Product::where('store_id', $storeId)
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Ambil banner aktif dari store Ropang, diurutkan berdasarkan order
        $banners = Banner::where('store_id', $storeId)
            ->where('status', 'active')
            ->orderBy('order', 'asc')
            ->get();
        
        // Pass variable ke view
        return view('ropang.ropang', compact('products', 'banners', 'store'));
    }
}