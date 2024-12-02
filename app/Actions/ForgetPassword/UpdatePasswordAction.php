<?php

namespace App\Actions\ForgetPassword;
use App\Models\User;
use App\Models\ResetPassword;
use Hash;
class UpdatePasswordAction
{
    /**
     * Create a new class instance.
     */
    public function execute($email,$request)
    {
        return User::where('email', $email)
             ->update(['password' => Hash::make($request->password)]);
        
    }
}