<?php

namespace App\Http\Controllers\CabinetUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ChangePasswordRequest;
use App\Actions\UpdateAccount\ChangePasswordAction;

class PasswordChangeController extends Controller
{
    public function __invoke() {
        return view('cabinet.change_password');
    }
    public function updatePassword(ChangePasswordRequest $request) {
        $user = (new ChangePasswordAction())->execute($request->validated());
        return response()->json([
            'success'=>  __('password_edit_success'),
            'redirect' => route('change_password')
        ]);
    }
}
