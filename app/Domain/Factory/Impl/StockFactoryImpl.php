<?php

namespace App\Domain\Factory\Impl;

use App\Domain\Factory\StockFactory;
use App\Domain\Repository\StockRepository;

class StockFactoryImpl implements StockFactory{

    
    private StockRepository $repository;

    public function __construct(StockRepository $repository)
    {
        $this->repository = $repository;
    }
    

    public function getStock(string $itemName, string $warehouseName){

        // リポジトリから取得する。
        $stock =$this->repository->getStockByName($itemName,$warehouseName);

        return $stock;

    }

}