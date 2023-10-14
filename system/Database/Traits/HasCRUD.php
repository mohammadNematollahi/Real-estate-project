<?php

namespace System\Database\Traits;

use System\Database\DBConnection\Connection;

trait HasCRUD
{
    protected function createMethod($values)
    {
        $values = $this->arrayToCastEncodeValue($values);
        $this->arrayToAttributes($values, $this);
        return $this->save();
    }
    protected function updateMethod($values)
    {
        $values = $this->arrayToCastEncodeValue($values);
        $this->arrayToAttributes($values, $this);
        return $this->save();
    }
    protected function allMethod()
    {
        //SELECT * FROM TBALE 
        $this->setSql("SELECT * FROM " . $this->getTableName());
        $stmt = $this->executeQuery();
        $result = $stmt->fetchAll();
        if (!empty($result)) {
            $this->arrayToObjects($result);
            return $this->collection;
        }
        return [];
    }
    protected function findMethod($id)
    {
        //SELECT * FORM TBALE WEHRE ID = ?;
        $this->setSql("SELECT * FROM " . $this->getTableName());
        $this->setWhere("AND", $this->getTableAttribute($this->primaryKey) . "=?");
        $this->addValues($this->primaryKey, $id);
        $stmt = $this->executeQuery();
        $result = $stmt->fetch();
        $this->setAllowedMethods(['update', 'delete', 'save']);
        if (!empty($result)) {
            return $this->arrayToAttributes($result);
        }
        return null;
    }

    protected function firstMethod()
    {
        $this->setSql("SELECT * FROM {$this->getTableName()}");
        $stmt = $this->executeQuery();
        $result = $stmt->fetch();
        if (!empty($result)) {
            return $this->arrayToAttributes($result);
        }
        return null;
    }

    protected function getMethod($array = [])
    {
        if ($this->sql == "") {
            if (empty($array)) {
                $query = $this->getTableName() . ".*";
            } else {
                foreach ($array as $key => $value) {
                    $array[$key] = $this->getTableAttribute($array[$key]);
                }
                $query = implode(", ", $array);
            }
            $this->setSql("SELECT " . $query . " FROM " . $this->getTableName());
        }
        $stmt = $this->executeQuery();
        $result = $stmt->fetchAll();
        if (!empty($result)) {
            $this->arrayToObjects($result);
            return $this->collection;
        }
        return [];
    }

    protected function whereMethod($attribute, $firstOp, $secendOp = null)
    {
        //wehre(attribute , $value OR operator , $value OR Operator) => (id , = , 11);
        $condition = '';
        $operator = "AND";
        if ($secendOp === null) {
            $condition = $this->getTableAttribute($attribute) . "=?";
            $this->addValues($attribute, $firstOp);
        } else {
            $condition = $this->getTableAttribute($attribute) . $firstOp . "?";
            $this->addValues($attribute, $secendOp);
        }
        $this->setWhere($operator, $condition);
        $this->setAllowedMethods(['where', 'whereOr', 'whereIn', 'whereNull', 'whereNotNull', 'limit', 'orderBy', 'get', 'paginate', 'first']);
        return $this;
    }
    protected function whereOrMethod($attribute, $firstOp, $secendOp = null)
    {
        //wehre(attribute , $value OR operator , $value OR Operator) => (id , = , 11);
        $condition = '';
        $operator = "OR";
        if ($secendOp === null) {
            $condition = $this->getTableAttribute($attribute) . "=?";
            $this->addValues($attribute, $firstOp);
        } else {
            $condition = $this->getTableAttribute($attribute) . $firstOp . "?";
            $this->addValues($attribute, $secendOp);
        }
        $this->setWhere($operator, $condition);
        $this->setAllowedMethods(['where', 'whereOr', 'whereIn', 'whereNull', 'whereNotNull', 'limit', 'orderBy', 'get', 'paginate' , 'first']);
        return $this;
    }
    protected function whereNullMethod($attribute)
    {
        //wehre id is null;
        $condition = '';
        $operator = "AND";
        $condition = $this->getTableAttribute($attribute) . " IS NULL ";
        $this->setWhere($operator, $condition);
        $this->setAllowedMethods(['where', 'whereOr', 'whereIn', 'whereNull', 'whereNotNull', 'limit', 'orderBy', 'get', 'paginate' , 'first']);
        return $this;
    }
    protected function whereNotNullMethod($attribute)
    {
        //wehre id is null;
        $condition = '';
        $operator = "AND";
        $condition = $this->getTableAttribute($attribute) . " IS NOT NULL ";
        $this->setWhere($operator, $condition);
        $this->setAllowedMethods(['where', 'whereOr', 'whereIn', 'whereNull', 'whereNotNull', 'limit', 'orderBy', 'get', 'paginate' ,'first']);
        return $this;
    }
    protected function deleteMethod($id = null)
    {
        $object = $this;
        $this->resetAll();
        if ($id) {
            $object = $this->findMethod($id);
            $this->resetAll();
        }
        //DELETE FROM TBALE WEHRE id = ?;
        $object->setSql("DELETE FROM " . $object->getTableName());
        $object->setWhere("AND", $this->getTableAttribute($this->primaryKey) . "=?");
        $object->addValues($object->primaryKey, $object->{$object->primaryKey});
        return $object->executeQuery();
    }
    protected function pageInateMethod($num)
    {
        $totlaRows = $this->getCount();
        $currentPage = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
        $totalSlide = ceil($totlaRows / $num);
        $currentPage = min($currentPage, $totalSlide);
        $currentPage = max($currentPage, 1);
        $totalRow = ($currentPage - 1) * $num;
        $this->setLimit($totalRow, $num);
        if ($this->sql == "") {
            $this->setSql("SELECT " . $this->getTableName() . ".*" . " FROM " . $this->getTableName());
        }
        $stmt = $this->executeQuery();
        $result = $stmt->fetchAll();
        if (!empty($result)) {
            return $this->arrayToAttributes($result);
        }
        return [];
    }
    protected function orderByMethod($name, $sort)
    {
        $this->setOrderBy($name, $sort);
        $this->setAllowedMethods(['limit', 'get', 'paginate']);
        return $this;
    }
    protected function limitMethod($from, $num)
    {
        $this->setLimit($from, $num);
        $this->setAllowedMethods(['limit', 'get', 'paginate']);
        return $this;
    }
    protected function saveMethod()
    {
        $fillString = $this->fillMethod();
        //INESRT INTO TABLE SET NAME = ? ;
        //UPDATE FROM TABLE SET NAME = ? WHERE ID = ?;
        if (!isset($this->{$this->primaryKey})) {
            $this->setSql("INSERT INTO " . $this->getTableName() . " SET " . $fillString . "," . $this->getTableAttribute($this->createdAt) . " =NOW()");
        } else {
            $this->setSql("UPDATE " . $this->getTableName() . " SET " . $fillString . "," . $this->getTableAttribute($this->updatedAt) . "=NOW()");
            $this->setWhere("AND", $this->getTableAttribute($this->primaryKey) . "=?");
            $this->addValues($this->primaryKey, $this->{$this->primaryKey});
        }
        $this->executeQuery();
        $this->resetAll();
        if (!isset($this->{$this->primaryKey})) {
            $object = $this->findMethod(Connection::lastInsert());
            $allowVar = get_class_vars(get_called_class());
            $allVar = get_object_vars($object);
            $diifArray = array_diff_key($allowVar, $allVar);
            foreach ($diifArray as $attribute) {
                $this->inCastsAttributes($attribute) == true ? $this->registerAttribute($this, $attribute, $this->castEncodeValue($attribute, $object->$attribute)) : $this->registerAttribute($this, $attribute, $object->$attribute);
            }
        }
        $this->resetAll();
        $this->setAllowedMethods(['update', 'delete', 'find']);
        return $this;
    }
    protected function fillMethod()
    {
        //image = ? , username = ? and value => addValues();
        $fillArray = [];
        foreach ($this->fillable as $attribute) {
            if (isset($this->$attribute) != null) {
                if ($this->$attribute === "") {
                    $this->$attribute = null;
                }
                array_push($fillArray, $attribute . "=?");
                $this->inCastsAttributes($attribute) == true ? $this->addValues($attribute, $this->castEncodeValue($attribute, $this->$attribute)) : $this->addValues($attribute, $this->$attribute);
            }
        }
        $fillString = implode(", ", $fillArray);
        return $fillString;
    }
}
