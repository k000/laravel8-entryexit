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

        // getは戻り値がコレクション
        $modelStock = ModelsStock::where('item_name', $itemName)->where('warehouse_name', $warehouoseName)->first();
        
        // todo refactor
        // 戻り値がCollectionです
        if($modelStock === null)
        {
            $stock->setItenName($itemName);
            $stock->setWarehouseName($warehouoseName);
            $stock->setCount(0);
            return $stock;
        }

        $stock->setItenName($modelStock->item_name);
        $stock->setWarehouseName($modelStock->warehouse_name);
        $stock->setCount($modelStock->count);

        return $stock;

    }


    public function insertOrUpdate(Stock $stock)
    {
        // 同一性が保持できていない
        $modelStock = new ModelsStock();
        $modelStock->warehouse_name = $stock->getWarehouseName();
        $modelStock->item_name = $stock->getItemName();
        $modelStock->count = $stock->getWillCount();
        $modelStock->save();

    }

}
