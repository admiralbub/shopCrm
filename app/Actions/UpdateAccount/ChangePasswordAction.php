<?php

namespace App\Actions\UpdateAccount;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class ChangePasswordAction
{
    /**
     * Create a new class instance.
     */
    public function execute(array $userData) : User
    {
        $userDetails = Auth::user();
        $user = User::find($userDetails->id); 

        $user->update([
            'password' => Hash::make($userData['password']),
            'updated_at' => now()
        ]);
        
        return $user;
        
    }
}