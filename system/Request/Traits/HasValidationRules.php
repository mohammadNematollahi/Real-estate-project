<?php

namespace System\Request\Traits;

use System\Database\DBConnection\Connection;

trait HasValidationRules
{
    public function normalValidation($name, array $rules)
    {
        // check rules : required , maxStr , minStr , exists , email , date
        foreach ($rules as $rule) {
            if ($rule == "required") {
                $this->required($name);
            } elseif (strpos($rule, "link") === 0) {
                $rule = str_replace("link", "", $rule);
                $this->isLink($name);
            } elseif (strpos($rule, "max:") === 0) {
                $rule = str_replace("max:", "", $rule);
                $this->maxStr($name, $rule);
            } elseif (strpos($rule, "min:") === 0) {
                $rule = str_replace("min:", "", $rule);
                $this->minStr($name, $rule);
            } elseif (strpos($rule, "existes:") === 0) {
                // existes : value , id ;
                $rule = str_replace("existes:", "", $rule);
                $getPar = explode(",", $rule);
                $checkParID = isset($getPar[1]) ? $getPar[1] : null;
                $this->existesIn($name, $getPar[0], $checkParID);
            } elseif (strpos($rule, "hash") === 0) {
                $this->hash($name);
            } elseif (strpos($rule, "email") === 0) {
                $this->email($name);
            } elseif (strpos($rule, "date") === 0) {
                $this->date($name);
            }
        }
    }
    public function numberValidation($name, array $rules)
    {
        // check rules : required , maxNum , minNum , exists , number
        foreach ($rules as $rule) {
            if ($rule == "required") {
                $this->required($name);
            } elseif (strpos($rule, "max:") === 0) {
                // title => max:255
                $rule = str_replace("max:", "", $rule);
                $this->maxNum($name, $rule);
            } elseif (strpos($rule, "min:") === 0) {
                // title => min:8
                $rule = str_replace("min:", "", $rule);
                $this->minNum($name, $rule);
            } elseif (strpos($rule, "existes:") === 0) {
                // existes : value , id ;
                $rule = str_replace("existes:", "", $rule);
                $getPar = explode(",", $rule);
                $checkParID = isset($getPar[1]) ? $getPar[1] : null;
                $this->existesIn($name, $getPar[0], $checkParID);
            } elseif (strpos($rule, "number:") === 0) {
                $this->number($name);
            }
        }
    }
    protected function maxStr($name, $count)
    {
        if ($this->checkFieldExist($name)) {
            if (strlen($this->request[$name]) >= (int) $count && $this->checkFirstError($name)) {
                $this->setError($name, "your input is more then 150 character");
            }
        }
    }

    protected function minStr($name, $count)
    {
        if ($this->checkFieldExist($name)) {
            if (strlen($this->request[$name]) <= $count && $this->checkFirstError($name)) {
                $this->setError($name, "message => minString");
            }
        }
    }
    protected function maxNum($name, $count)
    {
        if ($this->checkFieldExist($name)) {
            if ($this->request[$name] >= $count && $this->checkFirstError($name)) {
                $this->setError($name, "message => maxNumber");
            }
        }
    }
    protected function minNum($name, $count)
    {
        if ($this->checkFieldExist($name)) {
            if (strlen($this->request[$name] <= $count) && $this->checkFirstError($name)) {
                $this->setError($name, "message => minMumber");
            }
        }
    }
    protected function required($name)
    {
        if ($this->request[$name] == "" && $this->checkFirstError($name)) {
            $this->setError($name, "Oops pleace enter field " . $name);
        }
    }
    protected function number($name)
    {
        if ($this->checkFileExist($name)) {
            if (!is_numeric((int)$this->request[$name]) && $this->checkFirstError($name)) {
                $this->setError($name, "message => number");
            }
        }
    }

    protected function date($name)
    {
        if ($this->checkFieldExist($name)) {
            $regexDateShamsi = "/^1[3-4][0-9]{2}-(0[1-9]|1[0-2])-(0[1-3]|1[0-9]|2[0-9]|3[0-1])$/";
            if (!preg_match($regexDateShamsi, $this->request[$name]) && $this->checkFirstError($name)) {
                $this->setError($name, "massage => date");
            }
        }
    }
    protected function email($name)
    {
        if ($this->checkFieldExist($name)) {
            if (!filter_var($this->request[$name], FILTER_VALIDATE_EMAIL)) {
                $this->setError($name, "massage => email");
            }
        }
    }

    protected function isLink($name)
    {
        if ($this->checkFieldExist($name)) {
            if ($this->checkFirstError($name)) {
                if (!filter_var($this->request[$name], FILTER_VALIDATE_URL)) {
                    $this->setError($name, "your input {$name} is not valid url");
                }
            }
        }
    }

    protected function hash($name)
    {
        if ($this->checkFieldExist($name)) {
            if ($this->checkFirstError($name)) {
                $this->request[$name] = password_hash($this->request[$name], PASSWORD_DEFAULT);
            }
        }
    }
    public function existesIn($name, $table, $parameter)
    {
        if ($this->checkFieldExist($name)) {
            if ($this->checkFirstError($name)) {
                $sql = "SELECT COUNT(*) FROM `{$table}` WHERE `{$parameter}` = ?";
                $value = $this->request[$name];
                $instance = Connection::DBInstanse();
                $stmt = $instance->prepare($sql);
                $stmt->execute([$value]);
                $result = $stmt->fetchColumn();
                if ($result == 0 or $result === false) {
                    $this->setError($name, $name . " do not exist in database");
                }
            }
        }
    }
}
