<?php

namespace App\Http\Controller\Auth;

use App\Http\Controller\Auth\AuthController;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\User;

class ResetPasswordController extends AuthController
{
    public function index($id)
    {
        return view("auth.resetpassword", compact("id"));
    }
    public function sotre($id)
    {
        $request = new ResetPasswordRequest();
        $inputs = $request->all();
        $user = User::find($id);
        if (empty($user)) {
            error("notFindUser", "somting happened for find user");
            return back();
        } else if (!password_verify($inputs["new_password"], $inputs["password"])) {
            error("notEqual", "your inputs are not equal");
            return back();
        } else if (password_verify($inputs["new_password"] , $user->password)) {
            error("equal", "pleas enter new password");
            return back();
        }
        User::update(array_merge($inputs , ["id" => $id]));
        return redirect("Auth/Login");
    }
}
