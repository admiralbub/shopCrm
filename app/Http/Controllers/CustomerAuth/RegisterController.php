<?php

namespace App\Http\Controllers\CustomerAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\UserAuthManagerInterface;
class RegisterController extends Controller
{
    private $userAuthManager;

    public function __construct(UserAuthManagerInterface $userAuthManager) {
        $this->userAuthManager = $userAuthManager;
    }
    public function __invoke() {
        return view('auth.register');
    }
    public function getRegister(RegisterRequest $request) {
        $this->userAuthManager->registerUser($request);
        return response()->json([
            'success'=>  __('Login berhasil'),
            'redirect' => route('profile')
        ]);
    }
     
}
