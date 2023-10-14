<?php

namespace App\Http\Controller\Admin;

use App\Http\Controller\Controller;
use System\Auth\Auth;
use System\Database\DBConnection\Connection;

class PanelController extends Controller
{
    public function __construct()
    {
        $_SESSION["user"] = 1;
        Auth::isIt("is_active", 1);
        Auth::isIt("user_type", "admin");
    }
    public function index()
    {
        return view("admin.index");
    }
}
