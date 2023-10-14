<?php

namespace System\Database\Traits;

use System\Database\DBConnection\Connection;


trait HasQueryBuilder
{
    protected $sql = "";
    protected $where = [];
    protected $orderBy = [];
    protected $limit = [];
    protected $values = [];
    protected $bindValues = [];

    protected function setSql($query)
    {
        $this->sql = $query;
    }
    protected function getSql()
    {
        return $this->sql;
    }
    protected function resetSql()
    {
        $this->sql = "";
    }
    protected function setWhere($operator, $condition)
    {
        $componnets = array(
            "operator" => $operator,
            "condition" => $condition
        );
        array_push($this->where, $componnets);
    }
    protected function resetWhere()
    {
        $this->where = [];
    }
    protected function setOrderBy($name, $sort)
    {
        array_push($this->orderBy, $this->getTableAttribute($name) . " " . $sort);
    }
    protected function resetOrderBy()
    {
        $this->limit = [];
    }
    protected function setLimit($from, $num)
    {
        $this->limit["from"] = intval($from);
        $this->limit["number"] = intval($num);
    }
    protected function resetLimit()
    {
        unset($this->limit["from"]);
        unset($this->limit["number"]);
    }
    protected function addValues($name, $val)
    {
        $this->values[$name] = $val;
        array_push($this->bindValues, $val);
    }
    protected function removeVAlues()
    {
        $this->values = [];
        $this->bindValues = [];
    }
    protected function resetAll()
    {
        $this->resetSql();
        $this->resetWhere();
        $this->resetOrderBy();
        $this->resetLimit();
        $this->removeVAlues();
    }
    protected function executeQuery()
    {
        $query = "";
        $query = $this->sql;
        if (!empty($this->where)) {
            $wehreString = "";
            foreach ($this->where as $var) {
                $wehreString == "" ? $wehreString .= " " . $var["condition"] : $wehreString .= " " . $var["operator"] . " " . $var["condition"];
            }
            $query .= " WHERE " . $wehreString;
        }
        if (!empty($this->orderBy)) {
            $query .= " ORDER BY " . implode($this->orderBy);
        }
        if (!empty($this->limit)) {
            $query .= " limit " . $this->limit["from"] . ", " . $this->limit["number"];
        }
        $db = Connection::DBInstanse();
        $stmt = $db->prepare($query);
        if (count($this->bindValues) > count($this->values)) {
            count($this->bindValues) > 0 ? $stmt->execute($this->bindValues) : $stmt->execute();
        } else {
            count($this->values) > 0 ?  $stmt->execute(array_values($this->values)) : $stmt->execute();
        }
        return $stmt;
    }
    protected function getCount()
    {
        $query = "";
        $query = " SELECT COUNT(*) FROM " . $this->getTableName();
        if (!empty($this->where)) {
            $wehreString = "";
            foreach ($this->where as $var) {
                $wehreString == "" ? $wehreString .= " " . $var["condition"] : $wehreString .= " " . $var["operator"] . " " . $var["condition"];
            }
            $query .= " WHERE " . $wehreString;
        }
        $db = Connection::DBInstanse();
        $stmt = $db->prepare($query);
        if (count($this->bindValues) > count($this->values)) {
            count($this->bindValues) > 0 ? $stmt->execute($this->bindValues) : $stmt->execute();
        } else {
            count($this->values) > 0 ? $stmt->execute(array_values($this->values)) : $stmt->execute();
        }
        return $stmt->fetchColumn();
    }
    protected function getTableName()
    {
        return '`' . $this->table . "`";
    }
    protected function getTableAttribute($attribute)
    {
        return '`' . $this->table . "`.`" . $attribute . "`";
    }
}
