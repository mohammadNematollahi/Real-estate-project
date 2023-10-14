<?php

namespace System\Request\Traits;

use System\Config\Config;

trait HasFileValidationRules
{
    protected function fileValidation($name, array $rules)
    {
        foreach ($rules as $rule) {
            if ($rule === "required") {
                $this->fileRequired($name);
            } else if (strpos($rule, "mimes:") === 0) {
                $rule = str_replace("mimes:", "", $rule);
                $accessPath = explode(",", $rule);
                $this->fileType($name, $accessPath);
            } else if (strpos($rule, "max:") === 0) {
                $rule = str_replace("max:", "", $rule);
                $this->maxFile($name, $rule);
            } else if (strpos($rule, "min:") === 0) {
                $rule = str_replace("min:", "", $rule);
                $this->minFile($name, $rule);
            }
        }
    }

    protected function fileRequired($name)
    {
        if ($this->files[$name]["name"] == "" && $this->checkFirstError($name)) {
            $this->setError($name, $this->message(Config::get("validation.file.required"), $name));
        }
    }

    protected function fileType($name, $accessPath)
    {
        if ($this->checkFileExist($name) and $this->checkFirstError($name)) {
            $pathInfo = pathinfo($this->files[$name]["name"], PATHINFO_EXTENSION);
            if (!in_array($pathInfo, $accessPath)) {
                $this->setError($name, "massage => fileType");
            }
        }
    }
    protected function maxFile($name, $size)
    {
        $size = (int) $size * 1024;
        if ($this->checkFileExist($name) and $this->checkFirstError($name)) {
            if ($this->files[$name]["size"] > $size) {
                $this->setError($name, "massage => maxFile");
            }
        }
    }
    protected function minFile($name, $size)
    {
        $size = (int) $size * 1024;
        if ($this->checkFileExist($name) and $this->checkFirstError($name)) {
            if ($this->files[$name]["size"] < $size) {
                $this->setError($name, "massage => minFile");
            }
        }
    }
}
