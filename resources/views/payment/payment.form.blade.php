<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
</head>

<body>
    <h1>Thanh toán bằng VNPay</h1>

    <form action="{{ route('payment') }}" method="POST">
        @csrf
        <div>
            <label for="order_id">Mã đơn hàng:</label>
            <input type="text" name="order_id" required>
        </div>
        <div>
            <label for="amount">Số tiền:</label>
            <input type="number" name="amount" required>
        </div>
        <button type="submit">Thanh toán</button>
    </form>
</body>

</html>