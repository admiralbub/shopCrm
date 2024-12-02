<?php
namespace App\Services;
 
use App\Interfaces\UserAuthManagerInterface;
use App\Models\User;
use App\Models\ResetPassword;
use App\Actions\ForgetPassword\ForgetPasswordAction;
use App\Actions\ForgetPassword\UpdatePasswordAction;
use App\Actions\ForgetPassword\DeleteTokenAction;
use App\Actions\Registration\CreatedUserAction;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;    
use Snowfire\Beautymail\Beautymail;
use Session;
use Illuminate\Support\Facades\Auth;
class UserAuthManagerService implements UserAuthManagerInterface {

    static public function isEmailResetPassword($email) {
        return User::where('email', $email)->count();
    }
    static public function getResetPasswordToken($email) {
        $issueToken = ResetPassword::where('email', $email)->count();
        if ($issueToken == 0) {
            $token = Str::random(64);
            return (new ForgetPasswordAction())->execute($email, $token);
        } else {
            return null; // Returning null instead of an int
        }
    }
    static public function sendResetPasswordEmail($email,$token) {
        $beautymail = app()->make(Beautymail::class);
        $beautymail->send('email.reset_password', ['token' => $token],  function($message) use ($email)
        {
            $message
                ->from(config('app.email'))
                ->to($email)
                ->subject('Зміна паролю!');
        });
        return $beautymail;
    }
    static public function isToken($token) {
        return ResetPassword::where([
            'token' => $token
        ])->count();
    }
    static public function updatePasswordUser($token, $request) {
        $updatePassword = ResetPassword::where([
            'token' => $token
        ])->first();
        $forget_password = (new UpdatePasswordAction())->execute($updatePassword->email, $request);
        
        (new DeleteTokenAction())->execute($updatePassword->email);
        $user_is = User::where('email', $updatePassword->email)->first();


        return Auth::login($user_is);       

    }
    static public function authUser($request) {
        return Auth::attempt($request->only('email', 'password'));
    }
    static public function registerUser($request) {
        $user = (new CreatedUserAction())->execute($request->validated());
        return Auth::login($user);
    }
    static public function logoutUser() {
        Session::flush();
        Auth::logout();
  
       return true;
    }
}

?>