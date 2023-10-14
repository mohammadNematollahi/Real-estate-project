<?php

namespace System\router\Web;

class Router
{
    public static function get($url, $classMethod, $name = null)
    {
        $url = trim($url, "/ ");
        $classMethod = explode("@", $classMethod);
        $class = $classMethod[0];
        $method = $classMethod[1];
        global $routers;
        array_push($routers["get"], ["url" => $url, "class" => $class, "method" => $method , "name" => $name]);
    }
    public static function post($url, $classMethod, $name = null)
    {
        $url = trim($url, "/ ");
        $classMethod = explode("@", $classMethod);
        $class = $classMethod[0];
        $method = $classMethod[1];
        global $routers;
        array_push($routers["post"], ["url" => $url, "class" => $class, "method" => $method, "name" => $name]);
    }
    public static function put($url, $classMethod, $name = null)
    {
        $url = trim($url, "/ ");
        $classMethod = explode("@", $classMethod);
        $class = $classMethod[0];
        $method = $classMethod[1];
        global $routers;
        array_push($routers["put"], ["url" => $url, "class" => $class, "method" => $method, "name" => $name]);
    }
    public static function delete($url, $classMethod, $name = null)
    {
        $url = trim($url, "/ ");
        $classMethod = explode("@", $classMethod);
        $class = $classMethod[0];
        $method = $classMethod[1];
        global $routers;
        array_push($routers["delete"], ["url" => $url, "class" => $class, "method" => $method, "name" => $name]);
    }
}
