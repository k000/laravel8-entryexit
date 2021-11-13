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



    public function changeUpdate(StockDto $newDto, StockDto $oldDto)
    {

        $redStock = null;

        // もしも打消し明細になる場合は打消し明細を作成する
        if($newDto->itemName != $oldDto->itemName 
            || $newDto->warehouseName != $oldDto->warehouseName)
        {
            $redStock = $this->stockFactory->getStock($oldDto->itemName,$oldDto->warehouseName);
            // 打消し数を設定する
            $redStock->setScheduleCount($oldDto->count * -1);

            // バリデーションを行う
            $validationLogic = new StockUpdateValidation($redStock);
            $validationLogic->execute();
        }

        if($redStock == null){
            $diffCount = $oldDto->count - $newDto->count;

            $stock = $this->stockFactory->getStock($newDto->itemName,$newDto->warehouseName);
            // 予定数（入庫出庫）を設定する
            $stock->setScheduleCount($diffCount * -1);
            // バリデーションを行う
            $validationLogic = new StockUpdateValidation($stock);
            $validationLogic->execute();

            // 商品も倉庫も同一
            $this->repository->insertOrUpdate($stock);

        } else {

            // 新規と同様の登録を行う
            $this->update($newDto);
            // 商品または倉庫が違うので打消し明細を登録する
            $this->repository->insertOrUpdate($redStock);
        }

    }



    // updateに似ている
    public function deleteUpdate(StockDto $dto)
    {
        
        $stock = $this->stockFactory->getStock($dto->itemName,$dto->warehouseName);
        // 予定数（入庫出庫）を設定する
        $stock->setScheduleCount($dto->count * -1);

        // バリデーションを行う
        $validationLogic = new StockUpdateValidation($stock);
        $validationLogic->execute();

        // 登録する
        $this->repository->insertOrUpdate($stock);
    }

}
