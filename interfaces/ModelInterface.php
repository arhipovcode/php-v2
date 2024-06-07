<?php

namespace interfaces;

interface ModelInterface
{
    public function getById(int $id);
    public function getAll();
    public function getTableName(): string;
}
