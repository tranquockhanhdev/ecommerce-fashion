<?php

namespace App\Services;

use Carbon\Carbon;

class VNPayService
{
    protected $order;

    public function setOrderDetails($order)
    {
        $this->order = $order;
    }

    public function initPayment()
    {
        // Tạo các tham số cần thiết cho thanh toán VNPay
        // Các tham số bao gồm mã đơn hàng, tổng tiền, phí vận chuyển, v.v.
    }

    public function redirectToVNPay()
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.return');
        $vnp_TmnCode = "DN77PAHL";
        $vnp_HashSecret = "WFSM3G7HR05JYOGLTFEH7F1SEYWVBC56";

        // Các tham số đơn hàng
        $vnp_TxnRef = $this->order->id;

        $vnp_OrderInfo = "Thanh toán đơn hàng #" . $vnp_TxnRef;
        $vnp_Amount = $this->order->total * 100; // Số tiền cần thanh toán (đơn vị: đồng)
        $vnp_Locale = "VN"; // Có thể thay đổi theo ngôn ngữ người dùng
        $vnp_BankCode = "NCB"; // Chọn mã ngân hàng nếu cần
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        // Thời gian hiện tại theo múi giờ VN
        $vnp_CreateDate = Carbon::now('Asia/Ho_Chi_Minh')->format('YmdHis');
        $vnp_OrderType = 'billpayment';
        // Thời gian hết hạn (15 phút sau) theo múi giờ VN
        $vnp_ExpireDate = Carbon::now('Asia/Ho_Chi_Minh')->addMinutes(15)->format('YmdHis');

        // Tạo dữ liệu thanh toán
        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => $vnp_CreateDate,
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate" => $vnp_ExpireDate,
            "vnp_BankCode" => $vnp_BankCode,
        ];
        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00',
            'message' => 'success',
            'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
        return redirect()->to($vnp_Url);
    }
}
