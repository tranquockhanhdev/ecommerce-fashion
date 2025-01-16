<?php

namespace App\Http\Controllers\client;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\Account;
use App\Models\FavoriteProduct;
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
        $listWishlist = $user->favoriteProducts;
        foreach ($listWishlist as $wishlistItem) {
            $product = $wishlistItem->product;

            // If product quantity is 0 or status is 0, update the favorite status to 0
            if ($product->quantity == 0 || $product->status == 0) {
                $wishlistItem->update(['status' => 0]);
            }
            // If product quantity is greater than 0 and status is 1, update the favorite status to 1
            else if ($product->quantity > 0 && $product->status == 1) {
                $wishlistItem->update(['status' => 1]);
            }
        }

        return view('client.cart.wishlist', compact('listWishlist'));
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
