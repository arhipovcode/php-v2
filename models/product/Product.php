<?php

namespace models\product;

use models\model\Model;

class Product extends Model
{
    protected int $id;
    protected string $name;
    protected string $description;
    protected string $price;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Product
    {
        $this->id = $id;
        return $this;
    }

    public function getTableName(): string
    {
        return 'products';
    }
}
