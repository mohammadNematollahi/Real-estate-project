<?php

namespace App\Http\Controller\Admin;

use App\Http\Controller\Admin\PanelController;
use App\Http\Requests\Admin\UserRequest;
use App\Services\UploadPhoto;
use App\User;

class UserController extends PanelController
{
    public function index()
    {
        $users = User::all();
        return view("admin.user.index", compact("users"));
    }
    public function edit($id)
    {
        $user = User::find($id);
        return view("admin.user.edit", compact("user"));
    }
    public function update($id)
    {
        $request = new UserRequest();
        $inputs = $request->all();
        $approved =  $request->approved(["last_name", "first_name", "_method"]);
        if ($approved) {
            if ($request->file("avatar")) {
                $user = User::find($id);
                unlinkPhoto($user->avatar);
                $path = "images/users/" . date("Y/m/d");
                $name = date("Y_m_d_H_i_s") . "_" . rand(1, 20);
                $inputs["avatar"] = UploadPhoto::FileUpload($request->file("avatar"), $path, $name, 300, 300);
            }
            User::update(array_merge($inputs, ["id" => $id]));
        }
        redirect("admin/show-users");
    }
    public function changeActive($id)
    {
        $user = User::find($id);
        $status = $user->is_active == 0 ? 1 : 0;
        $is_active = ["is_active" => $status];
        User::update(array_merge($is_active, ["id" => $id]));
        return redirect("admin/show-users");
    }
}
