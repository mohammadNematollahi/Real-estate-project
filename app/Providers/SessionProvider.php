<?php

namespace App\Providers;

use App\Providers\Provider;

class SessionProvider extends Provider
{
    public function boot()
    {
        session_start();

        if (isset($_SESSION["temporary_error"])) {
            $_SESSION["error"] = $_SESSION["temporary_error"];
            unset($_SESSION["temporary_error"]);
        }
        
        if(isset($_SESSION["error"])){
            global $err;
            $err = $_SESSION["error"];
        }

        if (isset($_SESSION["old"])) {
            unset($_SESSION["temporary_old"]);
            $_SESSION["temporary_old"] = $_SESSION["old"];
            unset($_SESSION["old"]);
        }

        $params = [];
        isset($_REQUEST) ? $params = $_REQUEST : null;
        $_SESSION["old"] = $params;
        unset($params);
    }
}
