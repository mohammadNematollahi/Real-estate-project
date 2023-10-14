<?php

namespace App;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class Slide extends Model
{
    use HasSoftDelete;
    protected $table = "slides";
    protected $casts = ["image" => 'array'];
    protected $fillable = ["image", "title", "url", "address", "amount" , "description"];
    protected $deletedAt = "deleted_at";
}
