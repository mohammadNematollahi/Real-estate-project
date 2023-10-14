<?php

use System\View\ViewBuilder;
use System\Session\Session;

function dd($var, $exit = true)
{
    echo "<pre>";
    var_dump($var);
    if ($exit)
        exit;
}
function view($dir, array $vars = [])
{
    $viewBuilder = new ViewBuilder();
    $viewBuilder->run($dir);
    $varsComposer = $viewBuilder->varsComposer;
    $content = $viewBuilder->content;
    empty($varsComposer) ?: extract($varsComposer);
    empty($vars) ?: extract($vars);
    eval(" ?> " . html_entity_decode($content));
}
function html($resource)
{
    return html_entity_decode($resource);
}
function old($name)
{
    if (isset($_SESSION["temporary_old"][$name])) {
        return $_SESSION["temporary_old"][$name];
    } else {
        return null;
    }
}

function error($name, $message = null)
{
    global $err;
    unset($_SESSION["error"]);
    if ($message != null) {
        $_SESSION["temporary_error"][$name] = $message;
    }
    if ($err != null) {
        return isset($err[$name]) ? $err[$name] : null;
    }
}
function flash($name, $message = null)
{
    global $messageSend;
    if ($message == null) {
        if (!empty($_SESSION["message_flash"][$name])) {
            $messageSend[$name] = $_SESSION["message_flash"][$name];
            unset($_SESSION["message_flash"][$name]);
        } else {
            return false;
        }
    } else {
        $messageSend[$name] = $_SESSION["message_flash"][$name] = $message;
    }
    return $messageSend[$name];
}

function errorExist($name)
{
    return isset($_SESSION["temporary_error"][$name]) and $_SESSION["temporary_error"][$name] != null ? true : false;
}

function currentDomain()
{
    $protocol = $_SERVER["SERVER_PROTOCOL"] ? strpos($_SERVER["SERVER_PROTOCOL"], "HTTP") : "HTTPS";
    $current_domain = $protocol === false ? "https" : "http";
    return $current_domain . "://" . $_SERVER["HTTP_HOST"];
}
function redirect($dir)
{
    header("Location: " . trim(currentDomain(), "/ ") . "/" . trim($dir, "/ "));
    exit;
}

function back()
{
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit;
}

function asset($src)
{
    return trim(currentDomain(), " /") . "/" . trim($src, "/ ");
}
function url($url)
{
    return trim(currentDomain(), " /") . "/" . trim($url, "/ ");
}

function findRouteByName($name)
{
    global $routers;
    $url = '';
    $allRoute = array_merge(
        $routers["get"],
        $routers["post"],
        $routers["put"],
        $routers["delete"]
    );
    foreach ($allRoute as $element) {
        if ($element["name"] === $name && $element["name"] != null) {
            $url = $element["url"];
            break;
        }
    }
    return $url;
}

function route($name, $parameters = [])
{
    if (!is_array($parameters)) {
        throw new Exception("pleace enter array");
    }
    $url = findRouteByName($name);
    if ($url == null and $url == "") {
        throw new Exception("url is null");
    }
    $parameters = array_reverse($parameters);
    $routeMatchsParams = [];
    preg_match_all("/({[^}\.]*})/", $url, $routeMatchsParams);
    if (count($routeMatchsParams[0]) > count($parameters)) {
        throw new Exception("paramenter smaller then route");
    }
    foreach ($routeMatchsParams[0] as $key => $match) {
        $url = str_replace($match, array_pop($parameters), $url);
    }
    return trim(currentDomain(), " /") . "/" . trim($url, " /");
}

function methodField()
{
    $method = strtolower($_SERVER["REQUEST_METHOD"]);
    if ($method === "post") {
        if ($_POST["_method"] === 'post') {
            $method = "post";
        } else if ($_POST["_method"] === "put") {
            $method = "put";
        } else if ($_POST["_method"] === "delete") {
            $method = "delete";
        }
    }
    return $method;
}

function array_dot($array, $return_array = [], $return_key = "")
{
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $return_array = array_merge($return_array, array_dot($value, $return_array, $return_key . $key . "."));
        } else {
            $return_array[$return_key . $key] = $value;
        }
    }
    return $return_array;
}

function currentUrl()
{
    return trim(currentDomain(), " /") . $_SERVER["REQUEST_URI"];
}

function generateToken()
{
    return bin2hex(random_bytes(32));
}

function session($name)
{
    return Session::get($name);
}

function oldOrValue($name, $value)
{
    return old($name) !== null ?  old($name) :  $value;
}

function unlinkPhoto($path)
{
    if (file_exists($path)) {
        unlink($path);
    }
}

function setCsrfToken()
{
    $token = generateToken();
    Session::set("csrf", $token);
    return $token;
}

function now()
{
    return date("Y-m-d H:i:s");
}
