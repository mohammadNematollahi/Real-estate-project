<?php

namespace App\Http\Controller\Auth;

use App\Http\Requests\Auth\ForgotRequest;
use App\User;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Controller\Auth\AuthController;
use App\Services\EmailSendingService;
use System\Session\Session;

class LoginController extends AuthController
{
    public function index()
    {
        return view("auth.login");
    }
    public function store()
    {
        $request = new LoginRequest();
        $result = $request->all();
        $user = User::where('email', $result["email"])->first();
        if (!password_verify($result["password"],  $user->password)) {
            error("notEqual", "your email or your passwrod is not valide");
            return back();
        }
        if ($user->is_active == 1) {
            Session::set("user", $user->id);
            return redirect("");
        }
    }
    public function forgot()
    {
        return view("auth.forgot");
    }
    public function forgotStore()
    {
        $request = new ForgotRequest();
        $inputs = $request->all();
        $approved = $request->approved(['_method', 'email', 'csrf']);
        $token = generateToken();
        $subject = "<h2>this is email for forgot password</h2>";
        $message =
            "<p>
        if do you want change your password plase click under link </br>
        <a href='http://localhost:8000/Auth/Login/check-verifyToken?token={$token}' >link</a>
        </p>";
        if ($approved) {
            date_default_timezone_set("Asia/Tehran");
            $expire = date('Y-m-d H:i:s', strtotime('+10 minute'));
            $inputs["remember_token_expire"] = $expire;
            $inputs["remember_token"] = $token;

            EmailSendingService::SendMail($inputs["email"], $subject, $message);
            $user = User::where('email', $inputs["email"])->first();
            User::update(array_merge($inputs, ["id" => $user->id]));
        }
    }
    public function checkToken()
    {
        $user = User::where("remember_token", $_GET["token"])->first();
        if (empty($user)) {
            return view("errors.token");
        } else {
            if ($user->remember_token_expire < now()) {
                return view("errors.token");
            } else {
                return redirect("Auth/Reset-Password" . "/" . $user->id);
            }
        }
    }
}
