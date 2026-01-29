<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckStoreAccess
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login.store')->with('error', 'Silakan login terlebih dahulu');
        }

        // Super admin bisa akses semua
        if ($user->isSuperAdmin()) {
            return $next($request);
        }

        // User biasa harus punya store_id (ganti warung_id)
        if (!$user->store_id) {
            abort(403, 'Anda tidak memiliki akses ke toko manapun. Hubungi administrator.');
        }

        return $next($request);
    }
}