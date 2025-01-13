<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Account;
use App\Models\Order;
use App\Models\OrderCustomer;
use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\PaymentMethod;
use App\Models\WebsiteInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Exception;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function index($id)
    {
        $cart_id = $id;
        $account_id = Auth::user()->id;
        $website = WebsiteInfo::first();

        $orderItem = CartItem::where('cart_id', $cart_id)->get();
        $total = $orderItem->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        $userAddress = Auth::user()->address;
        $deliveryAddress = $website->address;

        $distance = $this->calculateDistance($userAddress, $deliveryAddress);

        // Tính phí vận chuyển
        $shippingCost = $this->calculateShippingCost($distance);
        $paymentMethods = PaymentMethod::all();
        return view('client.cart.checkout', compact('paymentMethods', 'orderItem', 'total', 'shippingCost', 'distance', 'shippingCost'));
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
