<?php

namespace App\Domain\Model\Entity;

use App\Domain\Model\ValueObject\Price;

class Item
{
    private string $name;

    private Price $price;

    public function __construct(string $name,int $price)
    {
        $this->name = $name;
        $this->price = new Price($price);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPirce()
    {
        return $this->price->get();
    }

    public function changeName(string $name)
    {
        $this->name = $name;
    }

    public function changePrice(Price $price)
    {
        $this->price = $price;
    }

}
