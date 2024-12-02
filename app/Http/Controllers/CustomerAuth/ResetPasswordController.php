<?php

namespace App\Http\Controllers\CustomerAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Interfaces\UserAuthManagerInterface;
use App\Models\ResetPassword;
class ResetPasswordController extends Controller
{
    private $userAuthManager;

    public function __construct(UserAuthManagerInterface $userAuthManager) {
        $this->userAuthManager = $userAuthManager;
    }
    public function __invoke() {
        return view('auth.forgot_password');
    }

    public function getForgetPassword(ForgotPasswordRequest $request) {
        if($this->userAuthManager->isEmailResetPassword($request->email) ==0) {
            return response()->json([
                'error'=>  __('This email is not in the database')
            ]);
        }
        $forgotPassToken = $this->userAuthManager->getResetPasswordToken($request->email);
       
        if($forgotPassToken !=null) {
            $sendEmailPass = $this->userAuthManager->sendResetPasswordEmail($request->email,$forgotPassToken);
        }

        if($forgotPassToken==null) {
            return response()->json([
                'error'=>  __('already_password_recovery')
            ]);
        }

        return response()->json([
            'success'=>  __('password_recovery_success'),
            'redirect' => route('forgot-password')
        ]);
        
    }
    public function showResetPasswordForm($token) {
        if($this->userAuthManager->isToken($token) == 0) {
            abort(404);
        }
        return view('auth.forgetPasswordLink', ['token' => $token]);
    }

    public function submitResetPasswordForm($token,ChangePasswordRequest $request) {
        $sendEmailPass = $this->userAuthManager->updatePasswordUser($token, $request);
        
        return response()->json([
            'success'=>  __('password_edit_success'),
            'redirect' => route('profile')
        ]);
    }
}
