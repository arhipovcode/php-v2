<?php

namespace models\catalog;

use models\model\Model;

class Catalogs extends Model
{
    public int $id = 0;
    public string $title;
    public string $description;
    public int $views_count;
    public int $price;
    public string $currency;
    public string $img_name;

    public function getTableName(): string
    {
        return "catalogs";
    }

    public function setSkippedKeys(): array
    {
        return ['views_count', 'currency'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getViewsCount(): int
    {
        return $this->views_count;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getImgName(): string
    {
        return $this->img_name;
    }

    public function setTitle(string $title): Catalogs
    {
        $this->title = $title;
        return $this;
    }

    public function setDescription(string $description): Catalogs
    {
        $this->description = $description;
        return $this;
    }

    public function setPrice(int $price): Catalogs
    {
        $this->price = $price;
        return $this;
    }

    public function setImgName(string $img_name): Catalogs
    {
        $this->img_name = $img_name;
        return $this;
    }

}
