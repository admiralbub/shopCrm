<?php

namespace App\Actions\ForgetPassword;
use App\Models\ResetPassword;
class DeleteTokenAction
{
    /**
     * Create a new class instance.
     */
    public function execute($email)
    {
        return ResetPassword::where('email', $email)->delete();
        
    }
}