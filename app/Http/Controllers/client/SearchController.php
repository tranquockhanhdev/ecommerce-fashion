<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;


class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query'); // Từ khóa

        // Tìm kiếm sản phẩm theo từ khóa
        $products = Product::query();

        if ($query) {
            $products->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', '%' . $query . '%')
                    ->orWhere('description', 'LIKE', '%' . $query . '%');
            });
        }

        // Lấy kết quả
        $products = $products->get();

        return response()->json([
            'success' => true,
            'products' => $products,
        ]);
    }
}
