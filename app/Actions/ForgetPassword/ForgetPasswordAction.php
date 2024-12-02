<?php

namespace App\Actions\ForgetPassword;
use App\Models\User;
use App\Models\ResetPassword;
class ForgetPasswordAction
{
    /**
     * Create a new class instance.
     */
    public function execute($email,$token)
    {
        $ResetPassword = ResetPassword::create([
            'email'=>$email,
            'token'=>$token,
        ]);
        
        return $token;
        
    }
}