<?php

namespace App\Http\Controller\Admin;

use App\Http\Controller\Admin\PanelController;
use App\Ads;
use App\Category;
use App\Http\Requests\Admin\AdsRequest;
use App\Services\UploadPhoto;

class AdsController extends PanelController
{
    public function index()
    {
        $ads = Ads::whereNull("deleted_at")->get();
        return view("admin.ads.index", compact("ads"));
    }
    public function create()
    {
        $categories = Category::whereNull("parent_id")->get();
        return view("admin.ads.create", compact("categories"));
    }
    public function store()
    {
        $request = new AdsRequest();
        $inputs = $request->all();
        $path = "images/ads/" . date("Y/m/d");
        $name = date("Y_m_d_H_s_i") . "_" . rand(1, 20);
        $inputs["image"] = UploadPhoto::FileUpload($request->file("image"), $path, $name, 1000, 1000);
        $inputs["user_id"] = session("user");
        $inputs["status"] = 0;
        Ads::create($inputs);
        redirect("admin/ads");
    }
    public function edit($id)
    {
        $categories = Category::whereNull("parent_id")->get();
        $advertise = Ads::find($id);
        return view("admin.ads.edit", compact("categories", "advertise"));
    }
    public function update($id)
    {
        $request = new AdsRequest();
        $inputs = $request->all();
        if ($request->file("image")) {
            $ads = Ads::find($id);
            unlinkPhoto($ads->image);
            $path = "images/ads/" . date("Y/m/d");
            $name = date("Y_m_d_H_s_i") . "_" . rand(1, 20);
            $inputs["image"] = UploadPhoto::FileUpload($request->file("image"), $path, $name, 1000, 1000);
        }
        Ads::update(array_merge($inputs, ["id" => $id]));
        redirect("admin/ads");
    }
    public function destroy($id)
    {
        Ads::delete($id);
        redirect("admin/ads");
    }
    public function gallery()
    {
        return view("admin.ads.gallery");
    }
}
