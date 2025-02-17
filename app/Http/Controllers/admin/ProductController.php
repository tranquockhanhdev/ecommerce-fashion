<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ColorProduct;
use App\Models\SizeProduct;
use App\Models\ProductDetail;
use App\Models\ImageProduct;
use App\Models\OrderItem;
use App\Models\CartItem;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products = Product::with(['category', 'images', 'details.color', 'details.size'])->get();


        return view('admin.qlsanpham.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::all();
        $colors = ColorProduct::all();
        $sizes = SizeProduct::all();

        return view('admin.qlsanpham.create', compact('categories', 'colors', 'sizes'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:product,name',
            'category_id' => 'required|exists:category,id',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'slug' => 'required|string|unique:product,slug|max:255',
            'description' => 'required|string',
            'status' => 'required|boolean',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'color_ids' => 'nullable|array',
            'color_ids.*' => 'exists:color_product,id',
            'size_ids' => 'nullable|array',
            'size_ids.*' => 'exists:size_product,id',
        ], [
            'name.unique' => 'Tên sản phẩm đã tồn tại. Vui lòng nhập tên khác.',
            'category_id.required' => 'Vui lòng chọn danh mục.',
            'category_id.exists' => 'Danh mục không hợp lệ.',
            'name.required' => 'Tên sản phẩm không được để trống.',
            'price.required' => 'Giá sản phẩm không được để trống.',
            'quantity.required' => 'Số lượng không được để trống.',
            'description.required' => 'Mô tả không được để trống.',
            'status.required' => 'Vui lòng chọn trạng thái.',
            'images.*.image' => 'Tệp phải là hình ảnh.',
            'images.*.mimes' => 'Chỉ chấp nhận ảnh có định dạng jpeg, png, jpg, gif.',
            'images.*.max' => 'Kích thước ảnh không vượt quá 2MB.',
            'color_ids.required' => 'Vui lòng chọn ít nhất một màu sắc.',
            'color_ids.*.exists' => 'Màu sắc không hợp lệ.',
            'size_ids.required' => 'Vui lòng chọn ít nhất một kích thước.',
            'size_ids.*.exists' => 'Kích thước không hợp lệ.',
        ]);


        $newProduct = Product::create($validatedData);


        if ($files = $request->file('images')) {
            $imageData = [];
            foreach ($files as $file) {
                $filename = time() . '-' . $file->getClientOriginalName();
                $path = 'products';
                $filePath = $file->storeAs($path, $filename, 'public');

                $imageData[] = [
                    'product_id' => $newProduct->id,
                    'link' => 'storage/' . $filePath,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            ImageProduct::insert($imageData);
        }


        if ($request->has('color_ids') || $request->has('size_ids')) {
            $colorIds = $request->has('color_ids') ? array_unique($request->color_ids) : [null];
            $sizeIds = $request->has('size_ids') ? array_unique($request->size_ids) : [null];

            foreach ($colorIds as $colorId) {
                foreach ($sizeIds as $sizeId) {

                    $existingDetail = ProductDetail::where('product_id', $newProduct->id)
                        ->where('colorproduct_id', $colorId)
                        ->where('sizeproduct_id', $sizeId)
                        ->first();


                    if (!$existingDetail) {
                        ProductDetail::create([
                            'product_id' => $newProduct->id,
                            'colorproduct_id' => $colorId,
                            'sizeproduct_id' => $sizeId,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('admin.qlsanpham.index')->with('success', 'Sản phẩm đã được thêm thành công!');
    }







    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $product = Product::with(['category', 'images', 'details.color', 'details.size'])->findOrFail($id);
        return view('admin.qlsanpham.show', compact('product'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $product = Product::with(['category', 'details.color', 'details.size', 'images'])->findOrFail($id);
        $categories = Category::all();
        $colors = ColorProduct::all();
        $sizes = SizeProduct::all();


        return view('admin.qlsanpham.edit', compact('product', 'categories', 'colors', 'sizes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function deleteImage($imageId)
    {

        $image = ImageProduct::findOrFail($imageId);


        Storage::disk('public')->delete(str_replace('storage/', '', $image->link));


        $image->delete();


        return response()->json(['message' => 'Xóa hình ảnh thành công.']);
    }

    public function update(Request $request, string $id)
    {
        // Validate input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:product,name,' . $id,
            'category_id' => 'required|exists:category,id',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'slug' => 'required|string|max:255|unique:product,slug,' . $id,
            'description' => 'required|string',
            'status' => 'required|boolean',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'color_ids' => 'nullable|array',
            'color_ids.*' => 'exists:color_product,id',
            'size_ids' => 'nullable|array',
            'size_ids.*' => 'exists:size_product,id',
        ], [
            'name.unique' => 'Tên sản phẩm này đã tồn tại, vui lòng chọn tên khác.',
            'slug.unique' => 'Slug sản phẩm này đã tồn tại, vui lòng chọn slug khác.',
        ]);

        // Lấy sản phẩm cần cập nhật
        $product = Product::findOrFail($id);

        // Cập nhật thông tin cơ bản của sản phẩm
        $product->update($validatedData);

        // Cập nhật hình ảnh
        if ($files = $request->file('images')) {
            // Thêm hình ảnh mới
            $imageData = [];
            foreach ($files as $file) {
                $filename = time() . '-' . $file->getClientOriginalName();
                $path = 'products';
                $filePath = $file->storeAs($path, $filename, 'public');

                $imageData[] = [
                    'product_id' => $product->id,
                    'link' => 'storage/' . $filePath,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Chỉ chèn hình ảnh mới vào database nếu có ảnh mới
            if (!empty($imageData)) {
                ImageProduct::insert($imageData);
            }
        }

        // Cập nhật các kết hợp màu sắc và kích thước
        if ($request->has('color_ids') || $request->has('size_ids')) {
            $colorIds = $request->has('color_ids') ? array_unique($request->color_ids) : [];
            $sizeIds = $request->has('size_ids') ? array_unique($request->size_ids) : [];

            // Duyệt qua các kết hợp màu và kích thước
            foreach ($colorIds as $colorId) {
                foreach ($sizeIds as $sizeId) {
                    // Kiểm tra kết hợp màu và kích thước đã tồn tại chưa
                    $existingProductDetail = ProductDetail::where('product_id', $product->id)
                        ->where('colorproduct_id', $colorId)
                        ->where('sizeproduct_id', $sizeId)
                        ->first();

                    // Nếu kết hợp chưa tồn tại, tạo mới
                    if (!$existingProductDetail) {
                        ProductDetail::create([
                            'product_id' => $product->id,
                            'colorproduct_id' => $colorId,
                            'sizeproduct_id' => $sizeId,
                        ]);
                    }
                }
            }
        }

        // Trả về trang danh sách sản phẩm với thông báo thành công
        return redirect()->route('admin.qlsanpham.index')->with('success', 'Sản phẩm đã được cập nhật thành công!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function toggleStatus($id)
    {
        $product = Product::find($id);

        if ($product) {
            // Chuyển trạng thái của sản phẩm từ hiển thị (1) sang ẩn (0) hoặc ngược lại
            $product->status = $product->status == 1 ? 0 : 1;
            $product->save();

            return response()->json([
                'status' => $product->status,
                'message' => 'Trạng thái sản phẩm đã thay đổi thành công!',
            ]);
        }

        return response()->json([
            'message' => 'Sản phẩm không tồn tại.',
        ], 404);
    }
    public function destroy($id)
    {
        // Tìm sản phẩm cần xóa
        $product = Product::findOrFail($id);

        // Xóa tất cả hình ảnh liên quan
        foreach ($product->images as $image) {
            // Xóa file vật lý
            Storage::disk('public')->delete(str_replace('storage/', '', $image->link));
            // Xóa bản ghi trong database
            $image->delete();
        }

        // Xóa tất cả chi tiết sản phẩm (màu, size)
        ProductDetail::where('product_id', $product->id)->delete();
        OrderItem::where('product_id', $product->id)->delete();
        CartItem::where('product_id', $product->id)->delete();
        Comment::where('product_id', $product->id)->delete();
        // Xóa sản phẩm
        $product->delete();

        // Trả về thông báo thành công
        return redirect()->route('admin.qlsanpham.index')->with('success', 'Sản phẩm đã được xóa thành công!');
    }
    public function filterAndSearch(Request $request)
    {
        $query = $request->input('query'); // Từ khóa tìm kiếm
        $categoryFilter = $request->input('category'); // Lọc theo danh mục
        $minPrice = $request->input('min_price'); // Lọc theo giá từ
        $maxPrice = $request->input('max_price'); // Lọc theo giá đến
        $ratings = $request->input('ratings', []); // Lọc theo đánh giá (mảng các sao)
        $sort = $request->input('sort'); // Giá trị sắp xếp

        // Loại bỏ ký tự đặc biệt, giữ lại Unicode, chữ cái, số và khoảng trắng
        if ($query) {
            $query = preg_replace('/[^\p{L}\p{N}\s]/u', '', $query); // Hỗ trợ Unicode
            $query = strtolower($query); // Chuyển thành chữ thường để đồng nhất với cơ sở dữ liệu
        }

        // Truy vấn sản phẩm kết hợp tìm kiếm, lọc theo danh mục, lọc theo giá và lọc theo đánh giá
        $products = Product::with(['images', 'comments'])
            ->when(!empty($query), function ($queryBuilder) use ($query) {
                // Sử dụng LIKE để tìm kiếm chính xác từ khóa, ví dụ: "áo"
                return $queryBuilder->where(function ($queryBuilder) use ($query) {
                    $queryBuilder->whereRaw('name RLIKE ?', ["{$query}"])
                        ->orWhereRaw('description RLIKE ?', ["{$query}"]);
                });
            })
            ->when(!empty($categoryFilter), function ($queryBuilder) use ($categoryFilter) {
                // Lọc theo danh mục
                return $queryBuilder->where('category_id', $categoryFilter);
            })
            ->when(!empty($minPrice), function ($queryBuilder) use ($minPrice) {
                // Lọc theo giá từ
                return $queryBuilder->where('price', '>=', $minPrice);
            })
            ->when(!empty($maxPrice), function ($queryBuilder) use ($maxPrice) {
                // Lọc theo giá đến
                return $queryBuilder->where('price', '<=', $maxPrice);
            })
            ->when(!empty($ratings), function ($queryBuilder) use ($ratings) {
                // Lọc theo đánh giá
                return $queryBuilder->whereHas('comments', function ($query) use ($ratings) {
                    return $query->whereIn('rating', $ratings);
                });
            })
            ->when(!empty($sort), function ($queryBuilder) use ($sort) {
                // Thêm điều kiện sắp xếp
                if ($sort === 'latest') {
                    return $queryBuilder->orderBy('created_at', 'desc'); // Sản phẩm mới nhất
                } elseif ($sort === 'oldest') {
                    return $queryBuilder->orderBy('created_at', 'asc'); // Sản phẩm cũ nhất
                } elseif ($sort === 'price_asc') {
                    return $queryBuilder->orderBy('price', 'asc'); // Giá thấp -> cao
                } elseif ($sort === 'price_desc') {
                    return $queryBuilder->orderBy('price', 'desc'); // Giá cao -> thấp
                }
            })
            ->paginate(12);

        // Lấy tất cả danh mục
        $categories = Category::all();

        // Trả về view với các sản phẩm đã lọc
        return view('client.shop.search_results', [
            'products' => $products,
            'categories' => $categories,
            'query' => $request->input('query'), // Truyền từ khóa gốc để hiển thị lại
            'categoryFilter' => $categoryFilter, // Truyền danh mục đã chọn
            'minPrice' => $minPrice, // Truyền giá từ
            'maxPrice' => $maxPrice, // Truyền giá đến
            'ratings' => $ratings, // Truyền các đánh giá đã chọn
            'sort' => $sort, // Truyền giá trị sắp xếp
        ]);
    }
}
