<?php

namespace App\Actions\UpdateAccount;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class UpdateAccountAction
{
    /**
     * Create a new class instance.
     */
    public function execute(array $userData) : User
    {
        $userDetails = Auth::user();
        $user = User::find($userDetails->id); 

        $user->update($userData);
        
        return $user;
        
    }
}