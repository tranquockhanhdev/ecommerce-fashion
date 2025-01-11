<?php

namespace App\Http\Controllers\admin;

use App\Models\WebsiteInfo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = 1;
        $website = WebsiteInfo::findOrFail($id);
        return view('admin.home.index', compact('website'));
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
