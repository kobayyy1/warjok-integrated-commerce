<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Banner;
use App\Models\Store;
use Illuminate\Http\Request;

class homeKoprollController extends Controller
{
    public function koprol()
    {
        // Ambil store Koproll (sesuaikan dengan ID di database Anda)
        // Jika Anda tahu ID store Koproll, gunakan find()
        // Atau gunakan where() dengan nama atau slug
        $store = Store::where('name', 'LIKE', '%Koproll%')->first();
        
        // Jika tidak ditemukan, coba dengan ID
        if (!$store) {
            $store = Store::find(1); // Sesuaikan dengan ID store Koproll
        }
        
        $storeId = $store ? $store->id : 1;
        
        // Ambil produk dari store Koproll yang aktif
        $products = Product::where('store_id', $storeId)
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Ambil banner aktif dari store Koproll, diurutkan berdasarkan order
        $banners = Banner::where('store_id', $storeId)
            ->where('status', 'active')
            ->orderBy('order', 'asc')
            ->get();
        
        // Pass variable ke view
        return view('koproll.koprollhome', compact('products', 'banners', 'store'));
    }
}