<?php

namespace services\database;

use PDO;
use traits\SingletonTrait;

class Db
{
    use SingletonTrait;

    private \PDO|null $connection = null;
    private array $config = [
        'driver' => "mysql",
        'host' => "localhost",
        'login' => "root",
        'password' => "ghjuhfvvf",
        'database' => "php_version_base",
        'charset' => "utf8",
    ];

    protected function getConnection(): ?\PDO
    {
        if (is_null($this->connection)) {
            $this->connection = new \PDO($this->buildDsn(), $this->config['login'], $this->config['password']);
            $this->connection->setAttribute(
                \PDO::ATTR_DEFAULT_FETCH_MODE,
                \PDO::FETCH_ASSOC
            );
        }

        return $this->connection;
    }

    protected function buildDsn(): string
    {
        return sprintf(
            "%s:dbname=%s;host=%s;charset=%s;",
            $this->config['driver'],
            $this->config['database'],
            $this->config['host'],
            $this->config['charset'],
        );
    }

    private function query(string $query, array $params = []): false|\PDOStatement
    {
        $pdoStatement = $this->getConnection()->prepare($query);
        $pdoStatement->execute($params);
        return $pdoStatement;
    }

    public function queryOne(string $query, int $id, $className = null)
    {
        if ($stmt = $this->query($query, ['id' => $id])) {
            if (isset($className)) {
                $stmt->setFetchMode(\PDO::FETCH_CLASS, $className);
            }
            return $stmt->fetch();
        }

        return false;
    }

    public function queryAll(string $query): false|array
    {
        if ($stmt = $this->query($query)) {
            return $stmt->fetchAll();
        }

        return false;
    }

    public function execute(string $query, array $params): int
    {
        return $this->query($query, $params)->rowCount();
    }

    public function delete(string $query, int $id): int
    {
        return $this->query($query, ['id' => $id])->rowCount();
    }
}
