<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\Secret;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class SecretController extends Controller
{
    public function showSecret()
    {
        $user = Auth::user();
        $secret = Secret::where('id', $user->secret_id)->first();

        return view('auth.hidesecretkey', ['secretContent' => $secret->content]);
    }
}
