<?php

namespace App\Http\Controllers\CustomerAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Interfaces\UserAuthManagerInterface;
class LogoutController extends Controller

{
    private $userAuthManager;

    public function __construct(UserAuthManagerInterface $userAuthManager) {
        $this->userAuthManager = $userAuthManager;
    }
    public function __invoke() {
        $this->userAuthManager->logoutUser();
        return Redirect('/');
    }
}
