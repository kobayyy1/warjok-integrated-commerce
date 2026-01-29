<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Banner;
use App\Models\Store;
use Illuminate\Http\Request;

class MieAyamController extends Controller
{
    public function mieayam()
    {
        // Ambil store Mie Ayam
        $store = Store::where('name', 'LIKE', '%Mie Ayam%')->first();
        
        // Jika tidak ditemukan, coba dengan ID store Mie Ayam
        if (!$store) {
            $store = Store::find(2); // ID store Mie Ayam
        }
        
        $storeId = $store ? $store->id : 2;
        
        // Ambil produk dari store Mie Ayam yang aktif
        $products = Product::where('store_id', $storeId)
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Ambil banner aktif dari store Mie Ayam, diurutkan berdasarkan order
        $banners = Banner::where('store_id', $storeId)
            ->where('status', 'active')
            ->orderBy('order', 'asc')
            ->get();
        
        // Pass variable ke view
        return view('mieayam.mieayamhome', compact('products', 'banners', 'store'));
    }
}