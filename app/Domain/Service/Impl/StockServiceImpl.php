<?php

namespace App\Domain\Service\Impl;

use App\Domain\Dto\StockDto;
use App\Domain\Factory\StockFactory;
use App\Domain\Logic\Validation\StockUpdateValidation;
use App\Domain\Repository\StockRepository;
use App\Domain\Service\StockService;

class StockServiceImpl implements StockService
{
    
    private StockFactory $stockFactory;

    private StockRepository $repository;

    public function __construct(StockFactory $factory,StockRepository $repository)
    {
        $this->stockFactory = $factory;
        $this->repository = $repository;
    }

    public function update(StockDto $dto)
    {
        $stock = $this->stockFactory->getStock($dto->itemName,$dto->warehouseName);
        // 予定数（入庫出庫）を設定する
        $stock->setScheduleCount($dto->count);

        // バリデーションを行う
        $validationLogic = new StockUpdateValidation($stock);
        $validationLogic->execute();

        // 登録する
        $this->repository->insertOrUpdate($stock);

    }
}
