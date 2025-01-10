<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Lấy tùy chọn sắp xếp từ query string
        $sort = $request->query('sort', 'latest');

        // Xử lý sắp xếp và phân trang
        switch ($sort) {
            case 'oldest':
                $articles = Article::with('category')->orderBy('created_at', 'asc')->paginate(2);
                break;
            default:
                $articles = Article::with('category')->latest()->paginate(2);
                break;
        }

        // Lấy bài viết gần đây
        $recentArticles = Article::orderBy('created_at', 'desc')->take(5)->get();

        // Lấy danh mục với số lượng bài viết
        $categories = Category::withCount('articles')->get();

        // Truyền biến vào view
        return view('client.blog.blog-list', compact('articles', 'recentArticles', 'categories', 'sort'));
    }


    // Tìm kiếm bài viết theo từ khóa
    public function search(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ query string
        $query = $request->input('search');

        // Tìm kiếm bài viết trong title hoặc content
        $articles = Article::where('title', 'like', '%' . $query . '%')
            ->orWhere('content', 'like', '%' . $query . '%')
            ->paginate(2);  // Phân trang kết quả tìm kiếm

            $recentArticles = Article::latest()->take(2)->get(); // Lấy 2 bài viết mới nhất

            $categories = Category::withCount('articles')->get();

        // Trả về view với kết quả tìm kiếm và từ khóa
        return view('client.blog.blog-list', compact('articles', 'query', 'categories', 'recentArticles',));
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
    public function show($id)
    {
        $article = Article::findOrFail($id);

        $recentArticles = Article::orderBy('created_at', 'desc')->take(3)->get();

        $categories = Category::withCount('articles')->get(); // Đếm số bài viết trong mỗi danh mục

        return view('client.blog.single-blog', compact('article', 'recentArticles', 'categories'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
