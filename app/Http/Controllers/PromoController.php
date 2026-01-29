<?php
namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller {
    public function index(Request $request) {
        $user = $request->user();
        $query = Promo::with('warung');

        if ($user->role === 'admin' && $user->warung_id) {
            $query->where('warung_id', $user->warung_id);
        }

        return response()->json($query->get(), 200);
    }

    public function store(Request $request) {
        $user = $request->user();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'discount_percentage' => 'required|integer|min:1|max:100',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $validated['warung_id'] = $user->role === 'super_admin' ? 
            $request->input('warung_id', 1) : $user->warung_id;

        $promo = Promo::create($validated);

        return response()->json([
            'message' => 'Promo berhasil dibuat',
            'data' => $promo,
        ], 201);
    }

    public function update(Request $request, Promo $promo) {
        $user = $request->user();

        if ($user->role === 'admin' && $promo->warung_id !== $user->warung_id) {
            return response()->json(['message' => 'Anda tidak memiliki akses'], 403);
        }

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'discount_percentage' => 'sometimes|integer|min:1|max:100',
            'is_active' => 'sometimes|boolean',
        ]);

        $promo->update($validated);

        return response()->json([
            'message' => 'Promo berhasil diperbarui',
            'data' => $promo,
        ], 200);
    }

    public function destroy(Request $request, Promo $promo) {
        $user = $request->user();

        if ($user->role === 'admin' && $promo->warung_id !== $user->warung_id) {
            return response()->json(['message' => 'Anda tidak memiliki akses'], 403);
        }

        $promo->delete();

        return response()->json(['message' => 'Promo berhasil dihapus'], 200);
    }
}
