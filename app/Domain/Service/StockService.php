<?php

namespace App\Domain\Service;

interface StockService
{
    public function update(string $itemName, string $warehouoseName);
}
