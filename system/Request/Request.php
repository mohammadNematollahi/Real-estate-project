<?php

namespace System\Request;

//for validaition we need trait

use Exception;
use System\Session\Session;
use System\Request\Traits\HasRunValidation;
use System\Request\Traits\HasValidationRules;
use System\Request\Traits\HasMessageValidation;
use System\Request\Traits\HasFileValidationRules;

class Request
{

    use HasValidationRules, HasFileValidationRules, HasRunValidation, HasMessageValidation;
    protected $request;
    protected $files = null;
    protected $errorExist = false;
    protected $errorVariablesName = [];


    public function __construct()
    {
        if (isset($_POST)) {
            if (
                isset($_POST["csrf"]) &&
                hash_equals($_POST["csrf"], Session::get("csrf")) &&
                $this->autorize()
            ) {
                $this->postAttributes();
            } else {
                return back();
            }
        }
        if (!empty($_FILES)) {
            $this->files = $_FILES;
        }
        $rules = $this->rules();
        if (!empty($rules)) {
            $this->run($rules);
        }
        $this->errorReadirect();
    }

    protected function rules()
    {
        return [];
    }

    public function file($name)
    {
        return isset($this->files[$name]) && $this->files[$name]["name"] != "" ? $this->files[$name] : false;
    }

    protected function run($rules)
    {
        foreach ($rules as $att => $values) {
            $rulesArray = explode("|", $values);
            if (in_array("file", $rulesArray)) {
                $this->fileValidation($att, $rulesArray);
            } elseif (in_array("number", $rulesArray)) {
                $this->numberValidation($att, $rulesArray);
            } else {
                $this->normalValidation($att, $rulesArray);
            }
        }
    }
    protected function postAttributes()
    {
        foreach ($_POST as $key => $value) {
            //(instance or request)->$first_name = ali;
            $this->$key = htmlentities($value);
            //$request[first_name]->ali;
            $this->request[$key] = htmlentities($value);
        }
    }
    public function approved(array $array)
    {
        if (!is_array($array)) {
            throw new Exception("input is not array please enter array");
        } else {
            $arrayDif = array_diff(array_keys($this->request), $array);
            if (empty($arrayDif)) {
                return true;
            } else {
                return false;
            }
        }
    }
    public function all()
    {
        // $instance->request;
        return $this->request;
    }
    public function autorize(): bool
    {
        return false;
    }
}
