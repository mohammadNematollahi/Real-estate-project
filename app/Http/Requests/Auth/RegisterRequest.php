<?php

namespace App\Http\Requests\Auth;

use System\Request\Request;

class RegisterRequest extends Request
{
    public function rules()
    {
        return[
            "email" => "required|max:191",
            "first_name" => "required|max:191",
            "last_name" => "required|max:191",
            "password" => "required|max:191|min:8|hash",
            "confirm_password" => "required|max:191|min:8",
            "checkbox" => "required"
        ];
    }
}
