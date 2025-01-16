<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Account;
use App\Models\Order;
use App\Models\OrderCustomer;
use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Cart;
use App\Models\PaymentMethod;
use App\Models\OrderItem;
use App\Models\WebsiteInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Services\VNPayService;


class CheckoutController extends Controller
{
    public function index($id)
    {
        $cart_id = $id;
        $account_id = Auth::user()->id;
        $website = WebsiteInfo::first();

        // Kiểm tra nếu không có thông tin website
        if (!$website || !$website->address) {
            return redirect()->route('client.cart.shopping-cart')->with('error', 'Thông tin địa chỉ giao hàng của website không tồn tại.');
        }

        // Kiểm tra xem người dùng có cung cấp địa chỉ hay không
        $userAddress = Auth::user()->address;
        if (!$userAddress) {
            return redirect()->route('client.cart.shopping-cart')->with('error', 'Bạn cần cập nhật địa chỉ của mình.');
        }

        // Kiểm tra giỏ hàng của người dùng
        $cart = Cart::firstOrCreate(['account_id' => $account_id]);

        // Kiểm tra xem giỏ hàng có sản phẩm hay không
        $orderItem = CartItem::where('cart_id', $cart_id)->get();
        if ($orderItem->isEmpty()) {
            return redirect()->route('client.cart.shopping-cart')->with('error', 'Giỏ hàng của bạn hiện không có sản phẩm.');
        }

        // Tính tổng giá trị các sản phẩm trong giỏ hàng
        $totalItem = $orderItem->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // Tính toán khoảng cách và phí vận chuyển
        $deliveryAddress = $website->address;
        $distance = $this->calculateDistance($userAddress, $deliveryAddress);

        $shippingCost = $this->calculateShippingCost($distance);

        // Làm tròn số đến 0 chữ số thập phân (số nguyên)
        $shippingCost = round($shippingCost);

        // Tổng tiền thanh toán
        $total = $totalItem + $shippingCost;

        // Lấy các phương thức thanh toán
        $paymentMethods = PaymentMethod::all();

        return view('client.cart.checkout', compact('paymentMethods', 'orderItem', 'totalItem', 'shippingCost', 'distance', 'total', 'cart'));
    }

    public function processCheckout(Request $request)
    {
        // Định nghĩa các quy tắc validation
        $validator = Validator::make($request->all(), [
            'account_id' => 'required|integer|exists:account,id', // Kiểm tra tài khoản hợp lệ
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'phone' => 'required|string|min:10|max:15', // Kiểm tra số điện thoại hợp lệ
            'payment' => 'required|in:1,2', // Kiểm tra phương thức thanh toán hợp lệ
            'shippingCost' => 'required|numeric|min:0',
            'totalItem' => 'required|numeric|min:0',
            'address' => 'required|string|max:255',
            'orderItem' => 'required|json', // Đảm bảo orderItem là một chuỗi JSON hợp lệ
        ]);

        // Kiểm tra nếu có lỗi validation
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $account_id = $request->account_id;
        $lastname = $request->lastname;
        $firstname = $request->firstname;
        $phone = $request->phone;
        $payment_method_id = $request->payment;
        $shipping_fee = $request->shippingCost;
        $total = $request->totalItem;
        $address = $request->address;
        $orderItems = json_decode($request->orderItem, true); // true để chuyển sang mảng

        // Lưu thông tin khách hàng
        $InfoCustomer = OrderCustomer::create([
            'account_id' => $account_id,
            'lastname' => $lastname,
            'firstname' => $firstname,
            'phone' => $phone,
            'address' => $address,
        ]);

        // Lưu đơn hàng
        $order = Order::create([
            'status' => 1,
            'status_payment' => 1,
            'shipping_fee' => $shipping_fee,
            'total' => $total,
            'created_at' => now(),
            'payment_method_id' => $payment_method_id,
            'ordercustomer_id' => $InfoCustomer->id,
        ]);

        // Lưu thông tin các sản phẩm trong đơn hàng
        foreach ($orderItems as $item) {
            OrderItem::create([
                'order_id' => $order->id, // ID của đơn hàng
                'product_id' => $item['product_id'], // ID sản phẩm
                'name' => $item['product']['name'], // Tên sản phẩm
                'quantity' => $item['quantity'], // Số lượng
                'price' => $item['price'], // Giá
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        // Xóa toàn bộ giỏ hàng sau khi đặt hàng thành công
        $cart = Cart::where('account_id', $account_id)->first(); // Lấy giỏ hàng của người dùng
        if ($cart) {
            CartItem::where('cart_id', $cart->id)->delete(); // Xóa các mục trong giỏ hàng
        }
        // Kiểm tra phương thức thanh toán và xử lý
        if ($payment_method_id == 1) {
            // Thanh toán VNPay: Chuyển hướng tới cổng thanh toán VNPay
            return $this->processVNPay($order);
        } elseif ($payment_method_id == 2) {
            // Thanh toán khi nhận hàng: Chuyển hướng đến trang lịch sử đơn hàng
            return redirect()->route('client.user.order-history')->with('success', 'Đơn Hàng Đã Đặt Hàng Thành Công!');
        }
    }

    // Hàm xử lý thanh toán qua VNPay
    public function processVNPay($order)
    {
        // Các tham số cần thiết cho VNPay
        $vnpay = new VNPayService();  // Giả sử bạn đã có class VNPayService để xử lý thanh toán VNPay
        $vnpay->setOrderDetails($order);  // Cài đặt các chi tiết đơn hàng như tổng tiền, số lượng, sản phẩm, etc.
        $vnpay->initPayment();  // Khởi tạo yêu cầu thanh toán
        // Chuyển hướng tới VNPay
        return $vnpay->redirectToVNPay();
    }

    public function vnpay_return(Request $request)
    {
        $fullUrl = $request->fullUrl();
        $vnp_TxnRef = $request->vnp_TxnRef;
        $vnp_HashSecret = "WFSM3G7HR05JYOGLTFEH7F1SEYWVBC56";
        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        // Kiểm tra mã bảo mật có khớp không
        if ($vnp_SecureHash == $secureHash) {
            // Kiểm tra trạng thái thanh toán
            if ($request->vnp_ResponseCode == '00') {
                // Thanh toán thành công
                $order = Order::where('id', $vnp_TxnRef)->first();
                $order->status_payment = 2; // Cập nhật trạng thái thanh toán thành công
                $order->save();

                // Chuyển hướng và thông báo thành công
                return redirect()->route('client.user.order-history')->with('success', 'Thanh toán thành công!');
            } else {
                // Thanh toán thất bại
                $order = Order::where('id', $vnp_TxnRef)->first();
                $order->status = 0;
                $order->status_payment = 0; // Cập nhật trạng thái thanh toán thất bại
                $order->save();
                // Xóa toàn bộ giỏ hàng sau khi đặt hàng thành công
                $cart = Cart::where('account_id', Auth::user()->id)->first(); // Lấy giỏ hàng của người dùng
                if ($cart) {
                    CartItem::where('cart_id', $cart->id)->delete(); // Xóa các mục trong giỏ hàng
                }
                // Chuyển hướng và thông báo lỗi
                return redirect()->route('client.user.order-history')->with('error', 'Thanh toán thất bại!');
            }
        } else {
            // Mã bảo mật không hợp lệ
            return redirect()->route('client.user.order-history')->with('error', 'Mã bảo mật không hợp lệ!');
        }
    }

    // Hàm tính khoảng cách giữa hai địa chỉ (Giả sử bạn dùng API của OpenStreetMap)
    private function calculateDistance($startAddress, $endAddress)
    {
        $startCoordinates = $this->getCoordinates($startAddress);

        $endCoordinates = $this->getCoordinates($endAddress);
        // Tính khoảng cách giữa 2 tọa độ
        $distance = $this->getDistanceFromCoordinates($startCoordinates, $endCoordinates);
        return $distance; // Đơn vị km
    }

    private function getCoordinates($address)
    {
        try {
            // Gửi yêu cầu đến API Nominatim
            $response = Http::withHeaders([
                'User-Agent' => 'YourAppName/1.0 (your-email@example.com)', // Thêm thông tin User-Agent
            ])->get("https://nominatim.openstreetmap.org/search", [
                'q' => $address,
                'format' => 'jsonv2',
            ]);

            // Kiểm tra nếu yêu cầu không thành công
            if ($response->failed()) {
                throw new Exception("Lỗi khi gọi API Nominatim.");
            }

            // Parse dữ liệu trả về
            $data = $response->json();

            // Kiểm tra dữ liệu trả về có hợp lệ không
            if (!empty($data)) {
                $latitude = $data[0]['lat'];
                $longitude = $data[0]['lon'];
                return ['lat' => $latitude, 'lon' => $longitude];
            }

            // Trả về null nếu không tìm thấy kết quả
            return null;
        } catch (Exception $e) {
            // Xử lý ngoại lệ và ghi log nếu cần
            Log::error("Lỗi khi lấy tọa độ: " . $e->getMessage());
            return null;
        }
    }


    // Hàm tính khoảng cách giữa 2 tọa độ (sử dụng công thức Haversine)
    private function getDistanceFromCoordinates($start, $end)
    {
        $earthRadius = 6371; // Đơn vị km

        $latFrom = deg2rad($start['lat']);
        $lonFrom = deg2rad($start['lon']);
        $latTo = deg2rad($end['lat']);
        $lonTo = deg2rad($end['lon']);

        $latDiff = $latTo - $latFrom;
        $lonDiff = $lonTo - $lonFrom;

        $a = sin($latDiff / 2) * sin($latDiff / 2) +
            cos($latFrom) * cos($latTo) *
            sin($lonDiff / 2) * sin($lonDiff / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c; // Khoảng cách tính theo km
        return $distance;
    }

    // Hàm tính phí vận chuyển
    private function calculateShippingCost($distance)
    {
        $distanceRate = 10000; // Phí 10,000 đồng/km

        // Tính phí vận chuyển
        $cost = $distance * $distanceRate;
        return $cost;
    }
}
