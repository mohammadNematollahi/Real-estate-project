<?php

namespace App;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class Post extends Model
{
    use HasSoftDelete;
    protected $table = "posts";
    protected $casts = ["image" => "array"];
    protected $fillable = ["title", "body", "cat_id", "user_id", "image", "published_at", "status"];
    protected $deletedAt = "deleted_at";

    public function category()
    {
        return $this->belongsTo("\App\Category", "cat_id", "id");
    }
    public function user()
    {
        return $this->hasOne("\App\User", "user_id", "id");
    }
}
