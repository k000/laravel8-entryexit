<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Entity\Stock;
use App\Domain\Repository\StockRepository;
use App\Models\Stock as ModelsStock;

class EloquentStockRepositoryImpl implements StockRepository{

    public function getStockByName(string $itemName, string $warehouoseName)
    {
        $stock = new Stock();

        // getは戻り値がコレクション
        $modelStock = ModelsStock::where('item_name', $itemName)->where('warehouse_name', $warehouoseName)->first();

        if($modelStock === null)
        {
            $stock->setId(0);
            $stock->setItenName($itemName);
            $stock->setWarehouseName($warehouoseName);
            $stock->setCount(0);
            return $stock;
        }
        $stock->setId($modelStock->id);
        $stock->setItenName($modelStock->item_name);
        $stock->setWarehouseName($modelStock->warehouse_name);
        $stock->setCount($modelStock->count);

        return $stock;

    }


    public function insertOrUpdate(Stock $stock)
    {
        // TODO インサートとアップデートで処理を分けたい
        $modelStock = null;

        // TODO 0を修正する
        if ($stock->getId() !== 0)
        {
            $modelStock = ModelsStock::find($stock->getId());
        } else {
            $modelStock = new ModelsStock();
            $modelStock->warehouse_name = $stock->getWarehouseName();
            $modelStock->item_name = $stock->getItemName();
        }

        $modelStock->count = $stock->getWillCount();
        $modelStock->save();

    }

    public function getAll()
    {
        // getは戻り値がコレクション
        $modelStock = ModelsStock::where('count', '>' , 0)->get();

        if($modelStock->isEmpty()){
            return;
        }

        $stocks = array();

        // collectionのeachを使うとクロージャなので$stocksが参照できない
        foreach($modelStock as $model)
        {
            $stock = new Stock();
            $stock->setItenName($model->item_name);
            $stock->setWarehouseName($model->warehouse_name);
            $stock->setCount($model->count);
            array_push($stocks,$stock);
        }

        return $stocks;
    }

}
