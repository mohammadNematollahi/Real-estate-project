<?php

return [
    "BASE_URL" => "http://" . $_SERVER["HTTP_HOST"],
    "CURRENT_URL" => "",
    "PROJECT_NAME" => "mvc-advance",
    "REQUEST_URI" => $_SERVER["REQUEST_URI"],
    "BDIR" => dirname(__DIR__),
    "Providers" => [
        App\Providers\SessionProvider::class,
        App\Providers\AppServiceProvider::class
    ]
];