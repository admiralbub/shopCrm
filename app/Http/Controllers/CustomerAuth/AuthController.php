<?php

namespace App\Http\Controllers\CustomerAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function __invoke() {
        return view('auth.auth');
    }
    public function getAuth(Request $request) {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect(route('profile'))->with('success', __('Login berhasil'));
        }
        return back()->with('error', __('title_auth_error'));
    }
}
