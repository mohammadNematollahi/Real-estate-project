<?php

namespace App\Http\Requests\Admin;

use System\Request\Request;

class PostRequest extends Request
{
    public function rules()
    {
        return [
            "title" => "required|max:255",
            "body" => "required|min:1",
            "cat_id" => "existes:categories,id",
            "image" => "file|mimes:jpg,svg,png|max:1000",
            "published_at" => "required"
        ];
    }
}
