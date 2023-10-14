<?php

namespace App\Http\Controller\Admin;

use App\Http\Controller\Admin\PanelController;
use App\Category;
use App\Http\Requests\Admin\CategoryRequest;

class CategoryController extends PanelController
{
    public function index()
    {
        $categories = Category::all();
        return view("admin.category.index", compact("categories"));
    }
    public function create()
    {
        $categories = Category::whereNull("parent_id")->get();
        return view("admin.category.create", compact("categories"));
    }
    public function store()
    {
        $request = new CategoryRequest();
        $resulte = $request->all();
        if ($resulte["parent_id"] == "")
            unset($resulte["parent_id"]);
        Category::create($resulte);
        return redirect("admin/category");
    }
    public function edit($id)
    {
        $category = Category::find($id);
        $categories = Category::whereNull("parent_id")->get();
        return view("admin.category.edit", compact("category", "categories"));
    }
    public function update($id)
    {
        $request = new CategoryRequest();
        $inputs = $request->all();
        Category::update(array_merge($inputs, ["id" => $id]));
        return redirect("admin/category");
    }
    public function destroy($id)
    {
        Category::delete($id);
        return redirect("admin/category");
    }
}
