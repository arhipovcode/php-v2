<?php

namespace models\model;

use interfaces\ModelInterface;
use services\database\Db;

abstract class Model implements ModelInterface
{
    protected string $tableName;
    protected Db $db;
    private array $bindParams = [];
    protected array $exclude = ['id', 'exclude', 'db', 'tableName', 'bindParams'];

    public function __construct()
    {
        $this->db = Db::getInstance();
        $this->tableName = $this->getTableName();
        $this->exclude = array_merge($this->exclude, $this->setSkippedKeys());
    }

    public static function getById(int $id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return DB::getInstance()->queryOne($sql, $id, get_called_class());
    }

    public static function getAll(): false|array
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }

    protected function insert(): int
    {
        $sql = $this->createInsertQuery();
        return $this->db->execute($sql, $this->bindParams);
    }

    protected function update(): int
    {
        $sql = $this->createUpdateQuery();
        return $this->db->execute($sql, array_merge($this->bindParams, ['id' => $this->id]));
    }

    public function remove(): int
    {
        $sql = "DELETE FROM {$this->tableName} WHERE id = :id";
        return $this->db->delete($sql, $this->id);
    }

    public function save()
    {
        $sql = "SELECT * FROM {$this->tableName} WHERE id = :id";
        $request = $this->db->queryOne($sql, $this->getId());

        if (!empty($request)) {
            return $this->update();
        }

        return $this->insert();
    }

    public function createInsertQuery():string
    {
        $dataValues = [];

        foreach ($this as $key => $value) {
            if (in_array($key, $this->exclude)) {
                continue;
            }
            $dataValues[] = $key;
            $this->bindParams[':' . $key] = $value;
        }

        $keys = implode(', ', $dataValues);
        $placeholders = implode(', ', array_map(function ($value) {
            return ':' . $value;
        }, $dataValues));

        return "INSERT INTO {$this->tableName} ($keys) VALUES ($placeholders)";
    }

    public function createUpdateQuery():string
    {
        $dataValues = [];

        foreach ($this as $key => $value) {
            if (in_array($key, $this->exclude)) {
                continue;
            }
            $dataValues[] = "$key = :$key";
            $this->bindParams[':' . $key] = $value;
        }

        $keys = implode(', ', $dataValues);

        return "UPDATE {$this->tableName} SET $keys WHERE id = :id";
    }

    abstract public static function getTableName(): string;
    abstract public function setSkippedKeys(): array;
}
