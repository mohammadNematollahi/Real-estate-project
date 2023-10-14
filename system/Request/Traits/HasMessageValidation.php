<?php

namespace System\Request\Traits;

use Exception;
use System\Config\Config;

trait HasMessageValidation
{
    protected function messageAttribute($str, $name)
    {
        $attributes = "";
        preg_match("/:attribute/", $str, $attributes);

        $nameInput = $name;
        $value = str_replace($attributes, $nameInput, $str);
        return $value;
    }

    protected function message($str, $name)
    {
        $message = $this->messageAttribute($str, $name);
        try {
            if (Config::get("validation.attributes." . $name)) {
                $attribute = Config::get("validation.attributes." . $name);
                preg_match("/:attribute/", $str, $attributes);

                $nameInput = $attribute;
                $result = str_replace($attributes, $nameInput, $str);
                return $result;
            }
        } catch (Exception $e) {
            return $message;
        }
    }
}
