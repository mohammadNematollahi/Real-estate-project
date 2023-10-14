<?php

namespace System\router;

use ReflectionMethod;
use System\Config\Config;

class Routing
{
    private $method_filde;
    private $current_url;
    private $routers;
    private $values = [];

    public function __construct()
    {
        $this->method_filde = $this->methodFilde();
        $this->current_url = explode("/", Config::get("app.CURRENT_URL"));
        global $routers;
        $this->routers = $routers;
    }
    public function methodFilde()
    {
        $methodFilde = strtolower($_SERVER["REQUEST_METHOD"]);
        if ($methodFilde == "post") {
            if (isset($_POST["_method"])) {
                if ($_POST["_method"] == "delete") {
                    $methodFilde = "delete";
                } else if ($_POST["_method"] == "put") {
                    $methodFilde = "put";
                }
            }
        }
        return $methodFilde;
    }

    public function comper($reservUrl)
    {
        if ($this->current_url[0] == "") {
            return true;
        } else {
            $reservUrlArray = explode("/", $reservUrl);
            if (count($reservUrlArray) != count($this->current_url)) {
                return false;
            } else {
                for ($i = 0; $i < count($reservUrlArray); $i++) {
                    if (substr($reservUrlArray[$i], 0, 1) == "{" and substr($reservUrlArray[$i], -1) == "}") {
                        array_push($this->values, $this->current_url[$i]);
                    } else if ($reservUrlArray[$i] != $this->current_url[$i]) {
                        return false;
                    }
                }
                return true;
            }
        }
    }
    public function match()
    {
        $typemethods = $this->routers[$this->method_filde];
        foreach ($typemethods as $typemethod) {
            if ($this->comper($typemethod["url"]) == true) {
                return [
                    "class" => $typemethod["class"],
                    "method" => $typemethod["method"]
                ];
            } else {
                $this->values = [];
            }
        }
        return [];
    }
    public function run()
    {
        $match = $this->match();
        if (empty($match)) {
            echo "404";
        } else {
            $matchClass = str_replace("\\", "/", $match["class"]);
            $path = realpath(Config::get("app.BDIR") . "/app/Http/Controller/" . $matchClass . ".php");
            if (!file_exists($path)) {
                echo "undefinde file";
            } else {
                $class = "\App\Http\Controller\\" . $match["class"];
                $obj = new $class();
                if (method_exists($obj, $match["method"])) {
                    $reflection = new ReflectionMethod($class, $match["method"]);
                    $parameters = $reflection->getNumberOfParameters();
                    if ($parameters <= count($this->values)) {
                        call_user_func_array(array($obj, $match["method"]), $this->values);
                    } else {
                        echo "undefinde parameters";
                    }
                } else {
                    echo "udefinde method";
                }
            }
        }
    }
}
