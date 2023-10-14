<?php

namespace App\Http\Controller\Admin;

use App\Http\Controller\Admin\PanelController;
use App\Http\Requests\Admin\SlideRequest;
use App\Services\UploadPhoto;
use App\Slide;

class SlideController extends PanelController
{
    public function index()
    {
        $slides = Slide::whereNull("deleted_at")->get();
        return view('admin.slide.index', compact("slides"));
    }

    public function create()
    {
        return view('admin.slide.create');
    }
    public function store()
    {
        $request = new SlideRequest();
        $result = $request->all();
        $path = "images/slides/" . date("Y/m/d");
        $name = date("Y_m_d_H_i_s") . "_" . rand(1, 20);
        $result["image"] = UploadPhoto::FileUpload($request->file("image"), $path, $name, 1000, 500);
        Slide::create($result);
        redirect("admin/slide");
    }
    public function edit($id)
    {
        $slide = Slide::find($id);
        return view("admin.slide.edit", compact("slide"));
    }
    public function update($id)
    {
        $slide = Slide::find($id);
        $request = new SlideRequest();
        $result = $request->all();
        if ($request->file("image")) {
            unlinkPhoto($slide->image);
            $path = "images/slides/" . date("Y/m/d");
            $name = date("Y_m_d_H_i_s") . "_" . rand(1, 20);
            $result["image"] = UploadPhoto::FileUpload($request->file("image"), $path, $name, 1000, 500);
        }
        Slide::update(array_merge($result, ["id" => $id]));
        redirect("admin/slide");
    }
    public function destroy($id)
    {
        Slide::delete($id);
        redirect("admin/slide");
    }
}
