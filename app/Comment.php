<?php

namespace App;

use System\Database\ORM\Model;

class Comment extends Model
{
    protected $table = "comments";
    protected $fillable = ["comment", "status", "approved" , "user_id" ,"post_id" ,"parent_id"];
    public function user()
    {
        return $this->belongsTo("\App\User", "user_id", "id");
    }

    public function post()
    {
        return $this->belongsTo("\App\Post", "post_id", "id");
    }
}
