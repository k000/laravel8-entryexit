<?php

namespace App\Domain\Service\Impl;

use App\Domain\Factory\StockFactory;
use App\Domain\Service\StockService;

class StockServiceImpl implements StockService
{
    
    private StockFactory $stockFactory;

    public function __construct(StockFactory $factory)
    {
        $this->stockFactory = $factory;
    }

    public function update(string $itemName, string $warehouoseName)
    {
       $model = $this->stockFactory->getStock($itemName,$warehouoseName);
    }
}
