<?php

namespace App\Domain\Service\Impl;

use App\Domain\Dto\StockDto;
use App\Domain\Logic\Service\EntryExitCreationLogic;
use App\Domain\Logic\Validation\EntryExitCreateValidation;
use App\Domain\Model\Entity\EntryExitDetail;
use App\Domain\Model\Entity\EntryExitSlip;
use App\Domain\Repository\NumberingRepository;
use App\Domain\Service\EntryExitService;
use App\Domain\Service\StockService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EntryExitServiceImpl implements EntryExitService
{

    private EntryExitCreationLogic $createtionLogic;

    private NumberingRepository $numberRepository;

    private StockService $stockService;

    public function __construct(EntryExitCreationLogic $logic, 
        NumberingRepository $numberRepository,StockService $stockService)
    {
        $this->createtionLogic = $logic;
        $this->numberRepository = $numberRepository;
        $this->stockService = $stockService;
    }

    public function create(Request $request)
    {

        // 採番処理
        $newNo = $this->numberRepository->getId("入出庫伝票");    

        // TODO create処理を切り出し
        // モデルの作成
        $slip = new EntryExitSlip();
        $slip->setEntryExitId($newNo);        
        $slip->setSlipDiv($request->slipdiv);
        $slip->setSlipDate(new Carbon($request->slipdate));
        $slip->setUpdateUser("testuser");

        $detail = new EntryExitDetail();
        $detail->setEntryExitNo($newNo);
        $detail->setDetailNo(1);
        $detail->setDetailDiv($request->detaildiv);
        $detail->setCount($request->count);
        $detail->setUnit($request->unit);
        $detail->setItemName($request->itemname);
        $detail->setwarehouseName($request->warehousename);

        $slip->safeAddDetail($detail);

        $validationLogic = new EntryExitCreateValidation($slip);
        $validationLogic->execute();

        // 在庫ロジック
        $stockDto = new StockDto($detail->getItemName(), $detail->getWarehouseName(), $detail->getCount());
        $this->stockService->update($stockDto);

        // 永続化処理
        $this->createtionLogic->create($slip);

    }

}
