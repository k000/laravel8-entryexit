<?php

namespace App\Domain\Dto;

class StockDto{

    public string $itemName;
    public string $warehouseName;
    public int $count;

    public function __construct(string $itemName, string $warehouName, int $count)
    {
        $this->itemName = $itemName;
        $this->warehouseName = $warehouName;
        $this->count = $count;
    }

}