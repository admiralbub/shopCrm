<?php

namespace App\Http\Controllers\CabinetUser;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateAccountRequest;
use App\Http\Controllers\Controller;
use App\Actions\UpdateAccount\UpdateAccountAction;
class ProfileController extends Controller
{
    
    public function __invoke() {
        return view('cabinet.profile');
    }
    public function getUpdate(UpdateAccountRequest $request) {
        $user = (new UpdateAccountAction())->execute($request->validated());

        return response()->json([
            'success'=>  __('profil_edit_success'),
            'redirect' => route('profile')
        ]);
    }

   
}
