<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Banner;
use App\Models\HeroVideo;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        // Inisialisasi default values
        $totalProducts = 0;
        $totalBanners = 0;
        $totalPromos = 0;
        $activeVideos = 0;
        $lowStockProducts = 0;
        $outOfStockProducts = 0;
        
        // Data perbandingan bulan lalu
        $productsLastMonth = 0;
        $productsGrowth = 0;

        // Recent activities
        $recentProducts = collect();
        $recentBanners = collect();
        $recentVideos = collect();

        try {
            // === PRODUCTS DATA ===
            if (Schema::hasTable('products')) {
                if ($user->isSuperAdmin()) {
                    // Total products
                    $totalProducts = Product::count();
                    
                    // Products added this month
                    $productsThisMonth = Product::whereMonth('created_at', Carbon::now()->month)
                        ->whereYear('created_at', Carbon::now()->year)
                        ->count();
                    
                    // Products added last month
                    $productsLastMonth = Product::whereMonth('created_at', Carbon::now()->subMonth()->month)
                        ->whereYear('created_at', Carbon::now()->subMonth()->year)
                        ->count();
                    
                    // Low stock products (stock <= 10)
                    $lowStockProducts = Product::where('stock', '<=', 10)
                        ->where('stock', '>', 0)
                        ->count();
                    
                    // Out of stock products
                    $outOfStockProducts = Product::where('stock', 0)->count();
                    
                    // Recent products (last 5)
                    $recentProducts = Product::with('store')
                        ->latest()
                        ->take(5)
                        ->get();
                } else {
                    // For store admin
                    $totalProducts = $user->store_id
                        ? Product::where('store_id', $user->store_id)->count()
                        : 0;
                    
                    $productsThisMonth = $user->store_id
                        ? Product::where('store_id', $user->store_id)
                            ->whereMonth('created_at', Carbon::now()->month)
                            ->whereYear('created_at', Carbon::now()->year)
                            ->count()
                        : 0;
                    
                    $productsLastMonth = $user->store_id
                        ? Product::where('store_id', $user->store_id)
                            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
                            ->whereYear('created_at', Carbon::now()->subMonth()->year)
                            ->count()
                        : 0;
                    
                    $lowStockProducts = $user->store_id
                        ? Product::where('store_id', $user->store_id)
                            ->where('stock', '<=', 10)
                            ->where('stock', '>', 0)
                            ->count()
                        : 0;
                    
                    $outOfStockProducts = $user->store_id
                        ? Product::where('store_id', $user->store_id)
                            ->where('stock', 0)
                            ->count()
                        : 0;
                    
                    $recentProducts = $user->store_id
                        ? Product::where('store_id', $user->store_id)
                            ->latest()
                            ->take(5)
                            ->get()
                        : collect();
                }

                // Calculate growth percentage
                if ($productsLastMonth > 0) {
                    $productsGrowth = round((($productsThisMonth - $productsLastMonth) / $productsLastMonth) * 100, 1);
                } else {
                    $productsGrowth = $productsThisMonth > 0 ? 100 : 0;
                }
            }

            // === BANNERS DATA ===
            if (Schema::hasTable('banners')) {
                if ($user->isSuperAdmin()) {
                    $totalBanners = Banner::count();
                    $activeBanners = Banner::where('is_active', true)->count();
                    $recentBanners = Banner::latest()->take(3)->get();
                } else {
                    $totalBanners = $user->store_id
                        ? Banner::where('store_id', $user->store_id)->count()
                        : 0;
                    $activeBanners = $user->store_id
                        ? Banner::where('store_id', $user->store_id)
                            ->where('is_active', true)
                            ->count()
                        : 0;
                    $recentBanners = $user->store_id
                        ? Banner::where('store_id', $user->store_id)
                            ->latest()
                            ->take(3)
                            ->get()
                        : collect();
                }
            }

            // === HERO VIDEOS DATA ===
            if (Schema::hasTable('hero_videos')) {
                $activeVideos = HeroVideo::where('is_active', true)->count();
                $recentVideos = HeroVideo::latest()->take(3)->get();
            }

            $weeklyData = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i);
                $weeklyData[] = [
                    'date' => $date->format('D'),
                    'products' => $user->isSuperAdmin()
                        ? Product::whereDate('created_at', $date)->count()
                        : Product::where('store_id', $user->store_id)
                            ->whereDate('created_at', $date)
                            ->count()
                ];
            }

        } catch (\Exception $e) {
            \Log::error('Dashboard error: ' . $e->getMessage());
        }

        return view('admin.dashboard', compact(
            'user',
            'totalProducts',
            'totalBanners',
            'totalPromos',
            'activeVideos',
            'lowStockProducts',
            'outOfStockProducts',
            'productsGrowth',
            // 'activeBanners',
            'recentProducts',
            'recentBanners',
            'recentVideos',
        ));
    }
}