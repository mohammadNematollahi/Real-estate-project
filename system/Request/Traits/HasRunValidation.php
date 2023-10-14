<?php

namespace System\Request\Traits;

trait HasRunValidation
{
    protected function errorReadirect()
    {
        if ($this->errorExist == false) {
            return $this->request;
        }
        return back();
    }

    private function checkFirstError($name)
    {
        if (!errorExist($name) && !in_array($name , $this->errorVariablesName)) {
            return true;
        }
        $this->errorReadirect();
        return false;
    }
    private function checkFieldExist($name)
    {
        if ($this->request[$name] != "" && !empty($this->request[$name])) {
            return true;
        }
        return false;
    }

    private function checkFileExist($name)
    {
        if (isset($this->files[$name]["name"]) && !empty($this->files[$name]["name"])) {
            return true;
        }
        return false;
    }
    private function setError($name, $errorMessage)
    {
        array_push($this->errorVariablesName, $name);
        error($name, $errorMessage);
        $this->errorExist = true;
    }
}
