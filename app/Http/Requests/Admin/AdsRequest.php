<?php

namespace App\Http\Requests\Admin;

use System\Request\Request;

class AdsRequest extends Request
{
    public function rules()
    {
        if (methodField() == "put") {
            return [
                "title" => "required|max:191",
                "address" => "required|max:191",
                "description" => "required|min:10",
                "cat_id" => "existes:categories,id",
                "image" => "file|mimes:jpg,svg,png|max:5000",
                "amount" => "number|required|min:1000000",
                "floor" => "required|max:191",
                "year" => "number|required",
                "storeroom" => "required",
                "balcony" => "required",
                "area" => "number|required",
                "room" => "number|required",
                "toilet" => "required",
                "parking" => "required",
                "tag" => "required|max:191",
                "type" => "required",
                "sell_status" => "required"
            ];
        } else {
            return [
                "title" => "required|max:191",
                "address" => "required|max:191",
                "description" => "required|min:10",
                "cat_id" => "existes:categories,id",
                "image" => "file|required|mimes:jpg,svg,png|max:5000",
                "amount" => "number|required|min:1000000",
                "floor" => "required|max:191",
                "year" => "number|required",
                "storeroom" => "required",
                "balcony" => "required",
                "area" => "number|required",
                "room" => "number|required",
                "toilet" => "required",
                "parking" => "required",
                "tag" => "required|max:191",
                "type" => "required",
                "sell_status" => "required"
            ];
        }
    }
}
