<?php

namespace App\Actions\Registration;
use App\Models\User;
class CreatedUserAction
{
    /**
     * Create a new class instance.
     */
    public function execute(array $userData): User
    {
        $user = User::create($userData);
        
        return $user;
        
    }
}