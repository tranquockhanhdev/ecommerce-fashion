<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Hiển thị giỏ hàng
    public function showCart()
    {
        $cart = Cart::where('account_id', Auth::id())->first();

        if (!$cart) {
            $cart = Cart::create([
                'account_id' => Auth::id(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Lọc sản phẩm theo status == 1 và sản phẩm còn tồn tại trong kho
        $cartItems = $cart->cartItems()
            ->with(['product.images', 'productDetails.color', 'productDetails.size'])
            ->whereHas('product', function ($query) {
                $query->where('status', 1)  // Điều kiện kiểm tra status = 1
                    ->where('quantity', '>', 0);  // Sản phẩm phải còn tồn kho
            })
            ->paginate(5);



        // Cập nhật lại giá sản phẩm trong giỏ hàng nếu có thay đổi
        foreach ($cartItems as $cartItem) {
            // Cập nhật giá sản phẩm từ bảng product
            $cartItem->price = $cartItem->product->price * $cartItem->quantity; // Cập nhật giá mới nhất
            $cartItem->save();
        }

        // Tính tổng giỏ hàng
        $total = $cartItems->sum(function ($item) {
            return $item->price; // Tính tổng giá đã cập nhật
        });

        return view('client.cart.shopping-cart', compact('cart', 'cartItems', 'total'));
    }

    public function addToCartJS(Request $request, $productId)
    {
        // Lấy thông tin sản phẩm từ cơ sở dữ liệu
        $product = Product::findOrFail($productId);

        // Lấy thông tin màu sắc và kích thước từ request
        $colorId = $request->input('color_id');
        $sizeId = $request->input('size_id');
        $quantity = $request->input('quantity', 1); // Số lượng mặc định là 1 nếu không có

        // Kiểm tra xem có tồn tại productdetail với color_id và size_id không
        $productDetail = ProductDetail::where('product_id', $productId)
            ->where('colorproduct_id', $colorId)
            ->where('sizeproduct_id', $sizeId)
            ->first();

        // Kiểm tra nếu không tìm thấy productdetail
        if (!$productDetail) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy chi tiết sản phẩm với màu sắc và kích thước này!'
            ]);
        }

        // Kiểm tra số lượng tồn kho
        if ($quantity > $product->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Số lượng yêu cầu vượt quá số lượng tồn kho!'
            ]);
        }

        // Kiểm tra giỏ hàng của người dùng
        $cart = Cart::firstOrCreate(['account_id' => Auth::id()]); // Tạo hoặc lấy giỏ hàng của người dùng

        // Kiểm tra giỏ hàng đã có sản phẩm với product_detail_id này chưa
        $cartItem = $cart->cartItems()->where('product_id', $productId)
            ->where('product_detail_id', $productDetail->id)
            ->first();

        if ($cartItem) {
            // Nếu sản phẩm đã có trong giỏ hàng, kiểm tra tổng số lượng
            $newQuantity = $cartItem->quantity + $quantity;

            if ($newQuantity > $product->quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Số lượng trong giỏ hàng vượt quá tồn kho!'
                ]);
            }

            // Cập nhật số lượng và tổng giá
            $cartItem->quantity = $newQuantity;
            $cartItem->price = $cartItem->quantity * $product->price; // Cập nhật giá tổng (quantity * price)
            $cartItem->save();
        } else {
            // Nếu sản phẩm chưa có trong giỏ hàng, thêm mới
            $cart->cartItems()->create([
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $product->price * $quantity, // Lưu tổng giá (quantity * product price)
                'product_detail_id' => $productDetail->id, // Lưu product_detail_id
            ]);
        }

        // Trả về phản hồi JSON
        return response()->json([
            'success' => true,
            'message' => 'Sản phẩm đã được thêm vào giỏ hàng thành công!'
        ]);
    }





    // Xóa sản phẩm khỏi giỏ hàng
    public function updateQuantity(Request $request, $cartItemId)
    {
        // Tìm cart item
        $cartItem = CartItem::findOrFail($cartItemId);

        // Lấy sản phẩm từ cart item
        $product = $cartItem->product;

        // Lấy số lượng mới từ request
        $quantity = $request->input('quantity');

        // Kiểm tra số lượng hợp lệ
        if ($quantity < 1) {
            return response()->json(['error' => 'Số lượng không hợp lệ.']);
        }

        // Kiểm tra số lượng tồn kho
        if ($quantity > $product->quantity) {
            return response()->json(['error' => 'Số lượng vượt quá số lượng tồn kho.']);
        }

        // Cập nhật số lượng trong giỏ hàng
        $cartItem->update([
            'quantity' => $quantity,
        ]);

        return response()->json(['success' => 'Cập nhật số lượng thành công!']);
    }



    public function update(Request $request, $id)
    {
        try {
            // Lấy thông tin sản phẩm trong giỏ hàng
            $cartItem = CartItem::findOrFail($id);

            // Kiểm tra nếu có thay đổi màu sắc
            if ($request->has('color_id') && $request->color_id != $cartItem->productDetails->color_id) {
                $productDetail = ProductDetail::where('product_id', $cartItem->product_id)
                    ->where('colorproduct_id', $request->color_id)
                    ->first();
            }

            // Kiểm tra nếu có thay đổi kích cỡ
            if ($request->has('size_id') && $request->size_id != $cartItem->productDetails->size_id) {
                $productDetail = ProductDetail::where('product_id', $cartItem->product_id)
                    ->where('sizeproduct_id', $request->size_id)
                    ->first();
            }

            // Kiểm tra nếu có thay đổi màu hoặc kích cỡ
            if (!isset($productDetail)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy chi tiết sản phẩm phù hợp.',
                ], 404);
            }

            // Cập nhật chi tiết sản phẩm trong giỏ hàng
            $cartItem->product_detail_id = $productDetail->id;
            $cartItem->save();

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật thành công!',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi khi cập nhật sản phẩm trong giỏ hàng.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function removeFromCart($cartItemId)
    {
        $cartItem = CartItem::find($cartItemId);

        if ($cartItem) {
            $cartItem->delete(); // Xóa sản phẩm khỏi giỏ hàng
        }

        return redirect()->route('client.cart.shopping-cart')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
    }
    public function removeAll(Request $request)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Bạn cần đăng nhập để xóa giỏ hàng.']);
        }

        $userId = Auth::id(); // Lấy ID người dùng đã đăng nhập

        // Lấy giỏ hàng của người dùng
        $cart = Cart::where('account_id', $userId)->first();

        if ($cart) {
            // Xóa tất cả các sản phẩm trong giỏ hàng của người dùng
            $cart->cartItems()->delete(); // Xóa tất cả các cart_items liên kết với giỏ hàng

            // Xóa giỏ hàng của người dùng
            $cart->delete(); // Xóa bản ghi giỏ hàng của người dùng

            return response()->json(['success' => true, 'message' => 'Giỏ hàng đã được xóa.']);
        }

        return response()->json(['success' => false, 'message' => 'Giỏ hàng của bạn hiện tại không có sản phẩm.']);
    }
    public function getCartData()
    {
        // Lấy giỏ hàng của người dùng
        $cart = Cart::where('account_id', Auth::id())->first();

        if (!$cart) {
            return response()->json(['success' => false, 'message' => 'Giỏ hàng trống']);
        }

        // Lấy các sản phẩm trong giỏ hàng và nạp thông tin về sản phẩm và hình ảnh (chỉ hiển thị sản phẩm có status = 1)
        $cartItems = $cart->cartItems()->with(['product' => function ($query) {
            $query->where('status', 1)->with(['images' => function ($query) {
                $query->limit(1); // Lấy 1 hình ảnh đầu tiên
            }]);
        }])->get();

        // Tính tổng giá trị giỏ hàng (chỉ tính sản phẩm có status = 1)
        $total = $cartItems->sum(function ($item) {
            return $item->product && $item->product->status == 1
                ? $item->product->price * $item->quantity
                : 0;
        });

        // Cập nhật đường dẫn hình ảnh từ thư mục 'storage'
        foreach ($cartItems as $item) {
            if ($item->product && $item->product->images->isNotEmpty()) {
                $item->product->images[0]->url = asset('' . $item->product->images[0]->link);
            }
        }

        return response()->json([
            'success' => true,
            'cartItems' => $cartItems->filter(function ($item) {
                return $item->product && $item->product->status == 1; // Chỉ trả về sản phẩm có status = 1
            }),
            'total' => $total,
        ]);
    }

    public function removeCart($cartItemId)
    {
        // Lấy sản phẩm và xóa khỏi giỏ hàng
        $cartItem = CartItem::find($cartItemId);  // Sửa Cart thành CartItem

        if (!$cartItem) {
            return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại trong giỏ hàng.']);
        }

        $cartItem->delete();

        return response()->json(['success' => true, 'message' => 'Sản phẩm đã được xóa khỏi giỏ hàng.']);
    }
}
