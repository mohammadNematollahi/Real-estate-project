<?php

namespace App;

use System\Database\ORM\Model;

class User extends Model
{
    protected $table = "users";
    protected $casts = ["avatar" => 'array'];
    // protected $hidden = ["password"];
    protected $fillable = ["first_name" , "last_name" ,"email" ,"avatar" ,"password" ,"status" , "is_active" ,"user_type","verify_token" ,"remember_token" ,"remember_token_expire"];
}