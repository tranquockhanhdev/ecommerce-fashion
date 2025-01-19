<?php

namespace App\Http\Controllers\admin;

use App\Models\WebsiteInfo;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Account;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = 1;
        $website = WebsiteInfo::findOrFail($id);

        // Các khoảng thời gian chung cho tháng, tuần và ngày hiện tại
        $dauThang = now()->startOfMonth();
        $cuoiThang = now()->endOfMonth();
        $dauTuan = now()->startOfWeek();
        $cuoiTuan = now()->endOfWeek();
        $today = today();

        // Đơn hàng có trạng thái 3
        $ordered = Order::where('status', 3);
        $orderedMonth = $ordered->whereBetween('created_at', [$dauThang, $cuoiThang])->sum('total');
        $productsSoldMonth = $ordered->whereBetween('created_at', [$dauThang, $cuoiThang])->count();
        $orderedWeek = $ordered->whereBetween('created_at', [$dauTuan, $cuoiTuan])->sum('total');
        $productsSoldWeek = $ordered->whereBetween('created_at', [$dauTuan, $cuoiTuan])->count();
        $orderedDay = $ordered->whereDate('created_at', $today)->sum('total');
        $productsSoldDay = $ordered->whereDate('created_at', $today)->count();

        // Số lượng tài khoản
        $contacted = Contact::count();
        $customer = Account::where('role', 'customer')->count();
        $newCustomersMonth = Account::where('role', 'customer')->whereBetween('created_at', [$dauThang, $cuoiThang])->count();
        $newCustomersWeek = Account::where('role', 'customer')->whereBetween('created_at', [$dauTuan, $cuoiTuan])->count();
        $newCustomersDay = Account::where('role', 'customer')->whereDate('created_at', $today)->count();


        // Lấy doanh thu theo từng tháng trong năm
        $monthlyRevenue = Order::where('status', 3)
            ->whereYear('created_at', now()->year)
            ->selectRaw('MONTH(created_at) as month, sum(total) as revenue')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        // Lấy ngày bắt đầu và kết thúc của tuần hiện tại
        $startOfWeek = Carbon::now()->startOfWeek(); // Lấy ngày bắt đầu tuần (Chủ nhật)
        $endOfWeek = Carbon::now()->endOfWeek(); // Lấy ngày kết thúc tuần (Thứ 7)

        // Truy vấn sử dụng Eloquent để lấy sản phẩm bán chạy trong tuần
        $topSellingProducts = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_quantity_sold'))
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])  // Lọc đơn hàng trong tuần
            ->groupBy('product_id')  // Nhóm theo product_id
            ->orderByDesc('total_quantity_sold')  // Sắp xếp theo số lượng bán ra giảm dần
            ->limit(10)  // Giới hạn kết quả lấy 10 sản phẩm bán chạy nhất
            ->get();

        // Lấy tên sản phẩm từ bảng products
        $products = $topSellingProducts->map(function ($orderDetail) {
            $product = Product::find($orderDetail->product_id);
            $orderDetail->product_name = $product ? $product->name : 'Unknown Product';
            return $orderDetail;
        });
        // Tạo mảng dữ liệu cho biểu đồ
        $months = $monthlyRevenue->pluck('month')->toArray();
        $revenues = $monthlyRevenue->pluck('revenue')->toArray();
        return view('admin.home.index', compact('website', 'ordered', 'contacted', 'customer', 'orderedMonth', 'productsSoldMonth', 'newCustomersMonth', 'orderedWeek', 'productsSoldWeek', 'newCustomersWeek', 'orderedDay', 'productsSoldDay', 'newCustomersDay', 'months', 'revenues', 'products'));
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
        $website = WebsiteInfo::findOrFail($id);

        // Validate input
        $request->validate([
            'site_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15|regex:/^\+?[0-9]*$/', // Kiểm tra số điện thoại
            'address' => 'required|string|max:500',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:5000', // Maximum size 1MB
        ], [
            'site_name.required' => 'Tên website không được bỏ trống',
            'email.required' => 'Email không hợp lệ',
            'email.email' => 'Email không hợp lệ',
            'phone.required' => 'Số điện thoại không hợp lệ',
            'phone.regex' => 'Số điện thoại chỉ chứa ký tự số hoặc ký hiệu "+" (nếu là số quốc tế)',
            'phone.max' => 'Số điện thoại không hợp lệ',
            'logo.image' => 'Logo chỉ được chấp nhận định dạng .png hoặc .jpg',
            'logo.mimes' => 'Logo chỉ được chấp nhận định dạng .png hoặc .jpg',
            'logo.max' => 'Logo không được vượt quá 1MB',
        ]);



        // Update fields
        $website->site_name = $request->site_name;
        $website->email = $request->email;
        $website->phone = $request->phone;
        $website->address = $request->address;

        // Handle logo upload if provided
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($website->logo && Storage::exists('logos/' . $website->logo)) {
                Storage::delete('logos/' . $website->logo);
            }

            // Store new logo
            $fileName = time() . '.' . $request->logo->extension();
            $request->logo->storeAs('logos', $fileName, 'public');
            $website->logo = $fileName;
        }
        $website->updated_at = now();
        $website->save();

        return redirect()->route('admin.index')->with('success', 'Cập Nhật Thông Tin Website Thành Công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
