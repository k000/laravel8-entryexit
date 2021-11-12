<?php

namespace App\Domain\Factory;

interface StockFactory{
    public function getStock(string $itemName, string $warehouseName);
}