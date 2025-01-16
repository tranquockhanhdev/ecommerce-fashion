<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Hiển thị giỏ hàng
    public function showCart()
    {
        // Lấy giỏ hàng của người dùng hiện tại
        $cart = Cart::where('account_id', Auth::id())->first();

        if (!$cart) {
            $cart = Cart::create([
                'account_id' => Auth::id(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Phân trang giỏ hàng
        $cartItems = $cart->cartItems()->with(['product.images'])->paginate(5);

        // Tính tổng giá trị giỏ hàng
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // Phân trang sản phẩm từ cửa hàng
        $products = Product::paginate(5);

        return view('client.cart.shopping-cart', compact('cart', 'cartItems', 'total', 'products'));
    }

    // Thêm sản phẩm vào giỏ hàng
    public function addToCart(Request $request, $productId)
    {
        // Lấy thông tin sản phẩm từ cơ sở dữ liệu
        $product = Product::findOrFail($productId);

        // Kiểm tra giỏ hàng của người dùng (giả sử bạn có một model Cart liên kết với user)
        $cart = Cart::firstOrCreate(['account_id' => Auth::id()]); // Tạo hoặc lấy giỏ hàng của người dùng

        // Lấy số lượng người dùng chọn từ form, mặc định là 1 nếu không có giá trị
        $quantity = $request->input('quantity', 1);

        // Tính tổng giá cho sản phẩm (giá * số lượng)
        $totalPrice = $product->price * $quantity;

        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        $cartItem = $cart->cartItems()->where('product_id', $productId)->first();

        if ($cartItem) {
            // Nếu sản phẩm đã có trong giỏ hàng, cập nhật số lượng và tổng giá
            $cartItem->quantity += $quantity;
            $cartItem->price = $cartItem->quantity * $product->price; // Cập nhật giá tổng (quantity * price)
            $cartItem->save();
        } else {
            // Nếu sản phẩm chưa có trong giỏ hàng, thêm mới
            $cart->cartItems()->create([
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $totalPrice, // Lưu tổng giá (quantity * product price)
            ]);
        }

        // Quay lại giỏ hàng
        // Gửi thông báo thành công
        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng thành công!');
    }
    public function addToCartJS(Request $request, $productId)
    {
        // Lấy thông tin sản phẩm từ cơ sở dữ liệu
        $product = Product::findOrFail($productId);

        // Kiểm tra giỏ hàng của người dùng (giả sử bạn có một model Cart liên kết với user)
        $cart = Cart::firstOrCreate(['account_id' => Auth::id()]); // Tạo hoặc lấy giỏ hàng của người dùng

        // Lấy số lượng người dùng chọn từ request, mặc định là 1 nếu không có giá trị
        $quantity = $request->input('quantity', 1);

        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        $cartItem = $cart->cartItems()->where('product_id', $productId)->first();

        if ($cartItem) {
            // Nếu sản phẩm đã có trong giỏ hàng, cập nhật số lượng và tổng giá
            $cartItem->quantity += $quantity;
            $cartItem->price = $cartItem->quantity * $product->price; // Cập nhật giá tổng (quantity * price)
            $cartItem->save();
        } else {
            // Nếu sản phẩm chưa có trong giỏ hàng, thêm mới
            $cart->cartItems()->create([
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $product->price * $quantity, // Lưu tổng giá (quantity * product price)
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

        // Lấy số lượng mới từ request
        $quantity = $request->input('quantity');

        // Kiểm tra số lượng hợp lệ
        if ($quantity < 1) {
            return redirect()->back()->with('error', 'Số lượng không hợp lệ.');
        }

        // Cập nhật số lượng
        $cartItem->update([
            'quantity' => $quantity,
        ]);

        return redirect()->back()->with('success', 'Cập nhật số lượng thành công!');
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
}
