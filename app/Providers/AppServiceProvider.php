<?php

namespace App\Providers;

use App\Ads;
use App\Category;
use App\Post;
use App\User;
use System\View\Composer;

class AppServiceProvider extends Provider
{
    public function boot()
    {
        Composer::view("*", function () {
            $ads = Ads::whereNull("deleted_at")->get();
            $sumArea = 0;
            foreach ($ads as $advertise) {
                $sumArea += (int) $advertise->area;
            }
            $usersCount = count(User::whereNull("deleted_at")->get());
            $postsCount = count(Post::whereNull("deleted_at")->get());
            return [
                "sumArea"       => $sumArea,
                "usersCount"    => $usersCount,
                "adsCount"      => count($ads),
                "postsCount"    => $postsCount
            ];
        });
    }
}
