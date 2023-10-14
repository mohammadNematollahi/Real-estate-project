<?php

namespace App\Http\Requests\Auth;

use System\Request\Request;

class ResetPasswordRequest extends Request
{
    public function rules()
    {
        return [
            "password" => "required|max:191|min:8|hash",
            "new_password" => "required|max:191:min:8"
        ];
    }
}
