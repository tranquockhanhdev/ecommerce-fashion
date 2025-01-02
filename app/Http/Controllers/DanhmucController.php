<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class DanhmucController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorys = Category::all();
        return view('admin.qldanhmuc.index', compact('categorys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.qldanhmuc.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Category::create($request->all());

        return redirect()->route('qldanhmuc.index')->with('success', 'Category created successfully.');
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
        $category = Category::findOrFail($id);
        $categories = Category::whereNull('parent_id')
                              ->where('id', '!=', $id) // Id không phải danh mục hiện tại
                              ->get();
    
        return view('admin.qldanhmuc.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id); 
        $category->update([
            'name' => $request->name,
            'image' => $request->image,
            'parent_id' => $request->parent_id,
            'status' => $request->status == 'Kích hoạt' ? 1 : 0, 
        ]);

        return redirect()->route('qldanhmuc.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id); 
        $category->delete(); 

        return redirect()->route('qldanhmuc.index')->with('success', 'Category deleted successfully');
    }
}
