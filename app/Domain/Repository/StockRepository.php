<?php

namespace App\Domain\Repository;


interface StockRepository
{
    public function getStockByName(string $itemName, string $warehouoseName);
}