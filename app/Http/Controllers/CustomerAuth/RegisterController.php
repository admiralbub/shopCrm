<?php

namespace App\Http\Controllers\CustomerAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Actions\Registration\CreatedUserAction;
use Illuminate\Support\Facades\Auth;
class RegisterController extends Controller
{
    public function __invoke() {
        return view('auth.register');
    }
    public function getRegister(RegisterRequest $request) {
        $user = (new CreatedUserAction())->execute($request->validated());
        Auth::login($user);
        return redirect(route('profile'));
    }
     
}
