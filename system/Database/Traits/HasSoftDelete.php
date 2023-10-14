<?php

namespace System\Database\Traits;

trait HasSoftDelete
{
    protected function deleteMethod($id = null)
    {
        $object = $this;
        $object->resetAll();
        if ($id) {
            $object = $this->findMethod($id);
            $this->resetAll();
        }
        $object->setSql("UPDATE " . $this->getTableName() . " SET " . $this->getTableAttribute($this->deletedAt) . "=NOW()");
        $object->setWhere("AND", $this->getTableAttribute($object->primaryKey) . "=?");
        $object->addValues($object->primaryKey, $id);
        return $object->executeQuery();
    }
    protected function findMethod($id)
    {
        $this->reesetAll();
        $this->setSql("SELECT " . $this->getTableName() . ".* FROM " . $this->getTableName());
        $this->setWhere("AND", $this->getTableAttribute($this->primaryKey) . "=?");
        $this->addValues($this->primaryKey, $id);
        $this->setWhere("AND", $this->getTableAttribute($this->deletedAt) . " IS NULL ");
        $stmt = $this->executeQuery();
        $result = $stmt->fetch();
        $this->setAllowedMethods(['update', 'delete', 'save']);
        if (!empty($result)) {
            return $this->arrayToAttributes($result);
        }
        return null;
    }
    protected function allMethod()
    {
        $this->resetAll();
        $this->setSql("SELECT " . $this->getTableName() . ".* FROM " . $this->getTableName());
        $this->setWhere("AND", $this->getTableAttribute($this->deletedAt) . " IS NULL ");
        $stmt = $this->executeQuery();
        $result = $stmt->fetchAll();
        if (!empty($result)) {
            $this->arrayToObjects($result);
            return $this->collection;
        }
        return [];
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
        $this->setWhere("AND", $this->getTableAttribute($this->deletedAt) . " IS NULL ");
        $stmt = $this->executeQuery();
        $result = $stmt->fetchAll();
        if (!empty($result)) {
            $this->arrayToObjects($result);
            return $this->collection;
        }
        return [];
    }

    protected function pagInateMethod($num)
    {
        $this->setWhere("AND", $this->getTableAttribute($this->deletedAt) . " IS NULL ");
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
        $stmt = $this->executeQery();
        $result = $stmt->fetchAll();
        if (!empty($result)) {
            return $this->arrayToObjects($result);
        }
        return [];
    }
}
