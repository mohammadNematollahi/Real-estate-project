<?php

namespace App\Http\Requests\Admin;

use System\Request\Request;

class SlideRequest extends Request
{
    public function rules()
    {
        if (methodField() == "put") {
            return [
                "title" => "required|max:191",
                "url" => "required|link|max:250",
                "address" => "required|max:191",
                "amount" => "number|required",
                "description" => "required",
                "image" => "file|mimes:jpg,svg,png|max:5000"
            ];
        } else {
            return [
                "title" => "required|max:191",
                "url" => "required|link|max:250",
                "address" => "required|max:191",
                "amount" => "number|required",
                "description" => "required",
                "image" => "file|required|mimes:jpg,svg,png|max:5000"
            ];
        }
    }
}
