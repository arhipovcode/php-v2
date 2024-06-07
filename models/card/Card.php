<?php

namespace models\card;

class Card
{
    public int $id;
    public string $name;
    public int $price;

    public function __construct(int $id, string $name, string $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }
}
