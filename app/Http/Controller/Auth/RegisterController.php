<?php

namespace App\Http\Controller\Auth;

use App\Http\Controller\Auth\AuthController;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\EmailSendingService;
use App\Services\UploadPhoto;
use App\User;
use System\Session\Session;

class RegisterController extends AuthController
{
    public function index()
    {
        return view("auth.register");
    }
    public function store()
    {
        $request = new RegisterRequest();
        $result = $request->all();
        if (hash_equals($result["confirm_password"], $result["password"])) {
            error("confirm_password", "passwords is not equal");
            return back();
        }
        if ($request->file("avatar")) {
            $path = "images/users/" . date("Y/m/d");
            $name = date("Y_m_d_H_i_s") . "_" . rand(1, 20);
            $result["avatar"] = UploadPhoto::FileUpload($request->file("avatar"), $path, $name, 500, 500);
        }
        unset($result["confirm_password"]);
        unset($result["checkbox"]);

        $token = generateToken();
        $result["verify_token"] = $token;

        $subject = "<h2>this is subject</h2>";
        $message = "
        <p>this is message <p>
        <br>
        <a href='http://localhost:8000/Auth/check-verifyToken?token={$token}'>link</a>";

        $send = EmailSendingService::SendMail($result["email"], $subject, $message);
        if ($send) {
            User::create($result);
            return redirect("success.sendEmail");
        }
    }

    public function checkToken()
    {
        $checkUser = User::where("verify_token", $_GET["token"])->first();
        if (!empty($checkUser)) {
            User::update(array_merge(["is_active" => 1], ["id" => $checkUser->id]));
            Session::set("user", $checkUser->id);
            return redirect("");
        } else {
            return view("errors.token");
        }
    }
}
