<?php

namespace App\Http\Controllers\client;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\Account;
use App\Models\Comment;
use App\Models\FavoriteProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentClientController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        // Lấy các comment của người dùng kèm thông tin sản phẩm
        $comments = Comment::where('account_id', $userId)
            ->with('product') // Eager load thông tin sản phẩm
            ->paginate(5);
        // Trả về view với dữ liệu
        return view('client.user.order-bought', compact('comments'));
    }
}
