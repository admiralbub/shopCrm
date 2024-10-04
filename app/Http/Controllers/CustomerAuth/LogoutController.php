<?php

namespace App\Http\Controllers\CustomerAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
class LogoutController extends Controller
{
    public function __invoke() {
        Session::flush();
        Auth::logout();
  
        return Redirect('/');
    }
}
