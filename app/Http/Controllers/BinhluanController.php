<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class BinhluanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::all();
        return view('admin.qlbinhluan.index', compact('comments'));
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
        $comment = Comment::findOrFail($id);

    // Kiểm tra nếu yêu cầu chỉ để cập nhật trạng thái
    if ($request->has('status')) {
        // Toggle status
        $comment->status = $request->status == 1 ? 0 : 1;
        $comment->save();

        return response()->json([
            'success' => true,
            'new_status' => $comment->status
        ]);
    }

    // Logic khác nếu cần cập nhật nội dung bình luận
    $comment->update($request->all());

    return redirect()->back()->with('success', 'Bình luận đã được cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->back()->with('success', 'Bình luận đã được xóa thành công!');
    }

}
