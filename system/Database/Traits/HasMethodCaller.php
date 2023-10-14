<?php

namespace System\Database\Traits;

trait HasMethodCaller
{
    private $allMethod = [
        "all", "get", "whereIn", "whereNotNull", "update", "create", "whereOr", "whereNull", "where", "delete", "find", "save", "limit", "orderBy", "pageInate", "first"
    ];
    private $allowMethod =  [
        "all", "get", "whereIn", "whereNotNull", "update", "create", "whereOr", "whereNull", "where", "delete", "find", "save", "limit", "orderBy", "pageInate", "frist"
    ];
    public function __call($method, $args)
    {
        //user->find(id , 1);
        return $this->methodCall($this, $method, $args);
    }
    public static function __callStatic($method, $args)
    {
        //user::find(id, 1);
        $class = get_called_class();
        $instance = new $class();
        return $instance->methodCall($instance, $method, $args);
    }
    private function methodCall($object, $method, $args)
    {
        $suffix = "Method";
        $fullNameMthod = $method . $suffix;
        if (in_array($method, $this->allowMethod)) {
            return call_user_func_array(array($object, $fullNameMthod), $args);
            //user::find(id,1)->delete();
        }
    }
    protected function setAllowedMethods(array $array)
    {
        $this->allowMethod = $array;
    }
}
