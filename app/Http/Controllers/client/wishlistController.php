<?php

namespace App\Http\Controllers\client;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\Account;
use App\Models\FavoriteProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class wishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem sản phẩm yêu thích.');
        }

        $listWishlist = FavoriteProduct::with('product')
            ->where('account_id', $user->id)
            ->where('status', 1)
            ->get();

        return view('client.cart.wishlist', compact('listWishlist'));
    }

    public function toggleFavorite($productId)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Vui lòng đăng nhập để thêm sản phẩm yêu thích.'], 401);
        }

        $favorite = FavoriteProduct::where('account_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['message' => 'Đã xóa sản phẩm khỏi danh sách yêu thích.']);
        } else {
            FavoriteProduct::create([
                'account_id' => $user->id,
                'product_id' => $productId,
                'status' => 1,
            ]);
            return response()->json(['message' => 'Đã thêm sản phẩm vào danh sách yêu thích.']);
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
