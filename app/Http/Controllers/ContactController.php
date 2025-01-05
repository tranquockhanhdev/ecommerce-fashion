<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::all(); // Lấy tất cả liên hệ từ DB
        return view('admin.qllienhe.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.qllienhe.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'email' => 'required|email',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Contact::create($request->all());

        return redirect()->route('admin.qllienhe.index')->with('success', 'Contact created successfully.');
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
        $contact = Contact::findOrFail($id);
        return view('admin.qllienhe.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'email' => 'required|email',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:chưa xử lý,đã xử lý', // Kiểm tra trạng thái dưới dạng số
        ]);

        $contact = Contact::findOrFail($id); // Lấy liên hệ cần sửa

        $contact->update([
            'user_name' => $request->user_name,
            'email' => $request->email,
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status, 
        ]);

        return redirect()->route('admin.qllienhe.index')->with('success', 'Contact updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id); // Lấy liên hệ cần xóa
        $contact->delete(); // Xóa liên hệ

        return redirect()->route('admin.qllienhe.index')->with('success', 'Contact deleted successfully');
    }
}
