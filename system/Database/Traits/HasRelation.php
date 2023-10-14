<?php

namespace System\Database\Traits;

trait HasRelation
{
    protected function hasOne($model, $foreignKey, $localKey)
    {
        if ($this->{$this->primaryKey}) {
            $instance = new $model();
            return $instance->getHasOneRelation($this->table, $foreignKey, $localKey, $this->$localKey);
        }
    }
    public function getHasOneRelation($table, $foreignKey, $otherKey, $otherkeyValue)
    {
        //SELECT phones.* FROM users JOIN phones ON users.id = phones.user_id;
        // select d.* from b as a inner join d as b on a.id = b.id_user;
        $this->setSql("SELECT `b`.* FROM `{$table}` AS `a` JOIN " . $this->getTableName() . " AS `b` ON `b`.`{$otherKey}`= `a`.`{$foreignKey}`");
        $this->setWhere("AND", "`a`.`{$otherKey}`= ?");
        $this->table = "b";
        $this->addValues($otherKey, $otherkeyValue);
        $statement = $this->executeQuery();
        $data = $statement->fetch();
        if ($data)
            return $this->arrayToAttributes($data);
        return null;
    }
    protected function hasMany($model, $foreignKey, $localKey)
    {
        if ($this->{$this->primaryKey}) {
            $instance = new $model();
            // dd($instance->getHasOneRelation($this->table, $foreignKey, $localKey, $this->$localKey));
            return $instance->getHasManyRelation($this->table, $foreignKey, $localKey, $this->$localKey);
        }
    }
    public function getHasManyRelation($table, $foreignKey, $otherKey, $otherkeyValue)
    {
        //SELECT phones.* FROM users JOIN phones ON users.id = phones.user_id;
        // select d.* from b as a inner join d as b on a.id = b.id_user;
        $this->setSql("SELECT `b`.* FROM `{$table}` AS `a` JOIN " . $this->getTableName() . " AS `b` ON `a`.`{$otherKey}`= `b`.`{$foreignKey}`");
        $this->setWhere("AND", "`a`.`{$otherKey}`= ?");
        $this->table = "b";
        $this->addValues($otherKey, $otherkeyValue);
        return $this;
    }
    protected function belongsTo($model, $foreignKey, $localKey)
    {
        if ($this->{$this->primaryKey}) {
            $instance = new $model();
            return $instance->getbelongsToRelation($this->table, $foreignKey, $localKey, $this->$foreignKey);
        }
    }
    public function getbelongsToRelation($model, $foreignKey, $otherKey, $foreignKeyValue)
    {
        //SELECT phones.* FROM users JOIN phones ON users.id = phones.user_id;
        // select d.* from b as a inner join d as b on a.id = b.id_user;
        $this->setSql("SELECT `b`.* FROM `{$model}` AS `a` JOIN " . $this->getTableName() . " AS `b` ON `a`.`{$foreignKey}`= `b`.`{$otherKey}`");
        $this->setWhere("AND", "`a`.`{$foreignKey}`= ?");
        $this->table = "b";
        $this->addValues($foreignKey, $foreignKeyValue);
        $statement = $this->executeQuery();
        $data = $statement->fetch();
        if ($data)
            return $this->arrayToAttributes($data);
        return null;
    }
    protected function belongsToMany($model, $linkTable, $localKey, $foreignKey, $middelForeignKey, $middleRelationKey, $localKeyValue)
    {
        if ($this->{$this->primaryKey}) {
            $instance = new $model();
            return $instance->getbelongsToManyRelation($this->table, $linkTable, $localKey, $foreignKey, $middelForeignKey, $middleRelationKey,  $this->$localKeyValue);
        }
    }
    public function getbelongsToManyRelation($model, $linkTable, $localKey, $foreignKey, $middelForeignKey, $middleRelationKey, $localKeyValue)
    {
        // select posts.* , categories.* from category_post inner join posts on category_post.post_id = posts.id inner join categories on category_post.cat_id = categories.id;
        
        //SELECT posts.* FROM ( SELECT comments.* FROM users JOIN comments on users.id = comments.user_id where users.id = 15) as relation JOIN posts on relation.post_id = posts.id;
        $this->setSql("SELECT `b`.* FROM ( SELECT `a`.* FROM `{$model}` AS `m` JOIN `{$linkTable}` AS `a` ON `m`.`{$localKey}` = `a`.`{$middelForeignKey}` WHERE `m`.`{$localKey}` = ?) AS relation JOIN " . $this->getTableName() . " AS `b` ON `relation`.`{$middleRelationKey}` = `b`.`{$foreignKey}`");
        $this->table = "a";
        $this->addValues("{$model}_{$localKey}",$localKeyValue);
        return $this;
    }
}