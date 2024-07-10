<?php

namespace interfaces;

interface ModelInterface
{
    public static function getById(int $id);
    public static function getAll();
    public static function getTableName(): string;
}
