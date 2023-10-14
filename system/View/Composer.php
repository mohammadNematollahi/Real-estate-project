<?php

namespace System\View;

class Composer
{
    // name , callback 

    private static $instance = null;

    private $vars = [];
    private $viewArray = [];

    private function __construct()
    {
    }

    private function setViewArray(array $currentView)
    {
        $this->viewArray = $currentView;
    }

    private function registerView($name, $callBack)
    {
        $name = trim($name, " .");
        $name = str_replace(".", "/", $name);
        if (in_array($name, $this->viewArray) or $name == "*") {
            $viewVars = $callBack();
            foreach ($viewVars as $key => $val) {
                $this->vars[$key] = $val;
            }
            if (isset($this->viewArray[$name])) {
                unset($this->viewArray[$name]);
            }
        }
    }
    private function getViewVars()
    {
        return $this->vars;
    }

    public static function __callStatic($method, $arguments)
    {
        $allowMethods = ["setViews", "view", "getVars"];
        $instance = self::getInstance();
        if ($method == $allowMethods[0]) {
            return call_user_func_array(array($instance, "setViewArray"), $arguments);
        } else if ($method == $allowMethods[1]) {
            return call_user_func_array(array($instance, "registerView"), $arguments);
        } else if ($method == $allowMethods[2]) {
            return call_user_func_array(array($instance, "getViewVars"), $arguments);
        }
    }
    private static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Composer();
        }
        return self::$instance;
    }
}
