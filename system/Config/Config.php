<?php

namespace System\Config;

class Config
{
    // [nameFile][nameArray][nameArray];
    private static $instance = null;
    private $file_name_brakect_array = [];
    private $file_name_dot_array = [];

    private function __construct()
    {
        $this->initialFileToArray();
    }
    private function initialFileToArray()
    {
        $configPath = dirname(dirname(__DIR__)) . "/config/";
        foreach (glob($configPath . "*.php") as $fileName) {
            $resultConfig = require $fileName;
            $key = $fileName;
            $key = str_replace($configPath, "", $key);
            $key = str_replace(".php", "", $key);
            $this->file_name_brakect_array[$key] = $resultConfig; // == [app][base_url];
        }
        $this->setCurrentRoute();
        $this->file_name_dot_array = $this->array_dot($this->file_name_brakect_array);
    }
    private function array_dot($array, $return_array = [], $return_key = '')
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $return_array = array_merge($return_array, $this->array_dot($value, $return_array, $return_key . $key . "."));
            } else {
                $return_array[$return_key . $key] = $value;
            }
        }
        return $return_array;
    }
    private function setCurrentRoute()
    {
        $current_url = trim(str_replace($this->file_name_brakect_array['app']["PROJECT_NAME"], "", $this->file_name_brakect_array["app"]["REQUEST_URI"]), "/");
        $current_url = explode("?", $current_url)[0];
        $this->file_name_brakect_array["app"]["CURRENT_URL"] = $current_url;
    }
    private static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public static function get($fileName)
    {
        $instance = self::getInstance();
        if (isset($instance->file_name_dot_array[$fileName])) {
            return $instance->file_name_dot_array[$fileName];
        } else {
            throw new \Exception("we cant not find this array " . $fileName);
        }
    }
}
