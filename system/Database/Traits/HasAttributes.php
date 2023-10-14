<?php

namespace System\Database\Traits;

trait HasAttributes
{
    private function registerAttribute($object, string $attribute, $value)
    {
        $this->inCastsAttributes($attribute) == true ? $object->$attribute = $this->castDecodeValue($attribute, $value) : $object->$attribute = $value;
    }
    protected function arrayToAttributes(array $array, $object = null)
    {
        if (!$object) {
            $className = get_called_class();
            $object = new $className();
        }
        foreach ($array as $key => $value) {
            if ($this->inHiddenAttributes($key))
                continue;
            $this->registerAttribute($object, $key, $value);
        }
        return $object;
    }
    protected function arrayToObjects(array $array)
    {
        $conllection = [];
        foreach ($array as $value) {
            $object = $this->arrayToAttributes($value);
            array_push($conllection, $object);
        }
        $this->collection = $conllection;
    }
    private function inHiddenAttributes($attribute)
    {
        return in_array($attribute, $this->hidden);
    }
    private function inCastsAttributes($attribute)
    {
        return in_array($attribute, array_keys($this->casts));
    }
    private function castDecodeValue($attributeKey, $value)
    {
        if ($this->casts[$attributeKey] === "array" || $this->casts[$attributeKey] === "object") {
            return unserialize($value);
        }
    }
    private function castEncodeValue($attributeKey, $value)
    {
        if ($this->casts[$attributeKey] === "array" || $this->casts[$attributeKey] === "object") {
            return serialize($value);
        }
    }
    private function arrayToCastEncodeValue($values)
    {
        $newArray = [];

        foreach ($values as $key => $value) {
            $this->inCastsAttributes($key) == true ? $newArray[$key] = $this->castEncodeValue($key, $value) : $newArray[$key] = $value;
        }
        return $newArray;
    }
}
