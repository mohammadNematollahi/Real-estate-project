<?php

namespace App\Http\Controller\Admin;

use App\Post;
use System\Config\Config;
use App\Services\UploadPhoto;
use App\Http\Requests\Admin\PostRequest;
use App\Http\Controller\Admin\PanelController;
use App\Category;

class PostController extends PanelController
{
    public function index()
    {
        $posts = Post::all();
        return view("admin.post.index", compact("posts"));
    }
    public function create()
    {
        $categories = Category::whereNull("parent_id")->get();
        return view("admin.post.create", compact("categories"));
    }
    public function store()
    {
        $request = new PostRequest();
        $inpusts = $request->all();
        $inpusts["user_id"] = session("user");
        $path = "images/posts/" . date("Y/m/d");
        $name = date("Y_m_d_H_s_i") . "_" . rand(1, 20);
        $inpusts["image"] = UploadPhoto::FileUpload($request->file("image"), $path, $name, 90, 80);
        $inpusts["published_at"] = stmpToDate($inpusts["published_at"]);
        Post::create($inpusts);
        redirect("admin/news");
    }
    public function edit($id)
    {
        $categories = Category::whereNull("parent_id")->get();
        $post = Post::find($id);
        return view("admin.post.edit", compact("categories", "post"));
    }
    public function update($id)
    {
        $request = new PostRequest();
        $inputs = $request->all();
        $inputs["published_at"] = stmpToDate($inputs["published_at"]);
        if ($request->file("image")) {
            $post = Post::find($id);
            unlinkPhoto($post->image);
            $path = "images/posts/" . date("Y/m/d");
            $name = date("Y_m_d_H_s_i") . "_" . rand(1, 20);
            $inputs["image"] = UploadPhoto::FileUpload($request->file("image"), $path, $name, 90, 90);
        }

        Post::update(array_merge($inputs, ["id" => $id]));
        redirect("admin/news");
    }

    public function destroy($id)
    {
        Post::delete($id);
        redirect("admin/news");
    }
}
