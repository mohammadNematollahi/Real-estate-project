<?php

namespace System\Application;

use System\router\Routing;

class Application
{
    public function __construct()
    {
        $this->loadHelpers();
        $this->loadProviders();
        $this->registerRoutes();
        $this->routing();
    }
    private function loadHelpers()
    {
        require_once(dirname(__DIR__) . "/helper/helpers.php");
        if (file_exists(dirname(dirname(__DIR__)) . "/app/Http/helpers.php")) {
            require_once dirname(dirname(__DIR__)) . "/app/Http/helpers.php";
        }
    }
    private function loadProviders()
    {
        $pathConfig = require dirname(dirname(__DIR__)) . "/config/app.php";
        $providers = $pathConfig["Providers"];
        foreach ($providers as $class) {
            $instance = new $class();
            $instance->boot();
        }
    }
    private function registerRoutes()
    {
        global $routers;

        $routers = array(
            "get" => [],
            "post" => [],
            "put" => [],
            "delete" => []
        );

        require_once dirname(dirname(__DIR__)) . "/router/api.php";
        require_once dirname(dirname(__DIR__)) . "/router/web.php";
    }
    private function routing()
    {
        $run = new Routing();
        $run->run();
    }
}
