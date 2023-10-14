<?php

namespace System\Session;

class Session
{
    public function set($name, $val)
    {
        $_SESSION[$name] = $val;
    }
    public function get($name)
    {
        return isset($_SESSION[$name]) ? $_SESSION[$name] : false;
    }
    public function remove($name)
    {
        unset($_SESSION[$name]);
    }

    public static function __callStatic($method, $arguments)
    {
        $instance = new self();
        return call_user_func_array(array($instance, $method), $arguments);
    }
}
