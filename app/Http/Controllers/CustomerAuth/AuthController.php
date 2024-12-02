<?php

namespace App\Http\Controllers\CustomerAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\UserAuthManagerInterface;
class AuthController extends Controller
{
    private $userAuthManager;

    public function __construct(UserAuthManagerInterface $userAuthManager) {
        $this->userAuthManager = $userAuthManager;
    }
    public function __invoke() {
        return view('auth.auth');
    }
    public function getAuth(Request $request) {
        if ($this->userAuthManager->authUser($request)) {
           
            return response()->json([
                'success'=>  __('Login berhasil'),
                'redirect' => route('profile')
            ]);
        }
        return response()->json([
            'error' => __('title_auth_error')
        ]);;
    }
}
