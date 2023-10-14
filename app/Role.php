<?php

namespace App;

use System\Database\ORM\Model;

class Role extends Model
{
    protected $table = "roles";
    protected $casts = [];
    protected $fillable = ["name"];

    public function users()
    {
        return $this->belongsToMany("\App\User", "user_role", "id", "id", "role_id", "user_id","id");
    }
}
