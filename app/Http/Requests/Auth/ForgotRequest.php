<?php

namespace App\Http\Requests\Auth;

use System\Request\Request;

class ForgotRequest extends Request
{
    public function rules()
    {
        return[
            "email" => "required|max:191|email|existes:users,email",
        ];
    }
}
