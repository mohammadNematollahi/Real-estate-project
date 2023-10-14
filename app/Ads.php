<?php

namespace App;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class Ads extends Model
{
    use HasSoftDelete;
    protected $table = "ads";
    protected $casts = ["image" => "array"];
    protected $fillable = ['title', 'description', 'address', 'amount', 'image', 'floor', 'year', 'storeroom', 'balcony', 'area', 'room', 'toilet', 'parking', 'tag', 'status', 'user_id', 'cat_id', 'sell_status', 'type', 'view'];
    protected $deletedAt = "deleted_at";

    public function user()
    {
        return $this->belongsTo("\App\User", "user_id", "id");
    }

    public function category()
    {
        return $this->belongsTo("\App\Category", "cat_id", "id");
    }
}