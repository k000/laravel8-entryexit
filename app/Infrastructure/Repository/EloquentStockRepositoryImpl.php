<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Entity\Stock;
use App\Domain\Repository\StockRepository;
use App\Models\Stock as ModelsStock;

use function PHPUnit\Framework\isEmpty;

class EloquentStockRepositoryImpl implements StockRepository{

    public function getStockByName(string $itemName, string $warehouoseName)
    {
        $stock = new Stock();

        $modelStock = ModelsStock::where('item_name', $itemName)->where('warehouse_name', $warehouoseName)->get();
        
        // todo refactor
        // 戻り値がCollectionです
        if($modelStock->isEmpty())
        {
            $stock->setItenName($itemName);
            $stock->setWarehouseName($warehouoseName);
            $stock->setCount(0);
            return $stock;
        }

        dd($modelStock);
        $stock->setItenName($modelStock->item_name);
        $stock->setWarehouseName($modelStock->warehouse_name);
        $stock->setCount($modelStock->itemcount_name);

        return $stock;

    }

}
