<?php

namespace App\Domain\Model\ValueObject;


class Price{

    private int $price;

    // todo change value object
    private float $tax = 0.8;

    public function __construct(int $price)
    {
        $this->price = $price;
    }

    public function get()
    {
        return $this->price;
    }


    public function getTaxIncluded()
    {
        return $this->price * $this->tax;
    }

    // 税率が変わったときの変更箇所が多くなる
    public function __taxIncluded(float $tax)
    {
        return $this->price * $tax;
    }
    
}
