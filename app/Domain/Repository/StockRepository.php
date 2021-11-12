<?php

namespace App\Domain\Repository;

use App\Domain\Model\Entity\Stock;

interface StockRepository
{
    public function getStockByName(string $itemName, string $warehouoseName);

    public function insertOrUpdate(Stock $stock);
}