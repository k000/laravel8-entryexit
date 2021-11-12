<?php

namespace App\Domain\Factory;

use App\Domain\Model\Entity\Stock;

interface StockFactory{
    public function getStock(string $itemName, string $warehouseName);
}