<?php
namespace App\Interfaces;

use App\Models\User;
use App\Models\ResetPassword;
interface UserAuthManagerInterface {
    static public function isEmailResetPassword($email);
    static public function getResetPasswordToken($email);
    static public function sendResetPasswordEmail($email,$token);
    static public function updatePasswordUser($token, $request);
    static public function isToken($token);
    static public function authUser($request);
    static public function registerUser($request);
    static public function logoutUser();
}