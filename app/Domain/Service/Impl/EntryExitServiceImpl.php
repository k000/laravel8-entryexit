<?php

namespace App\Domain\Service\Impl;

use App\Domain\Dto\StockDto;
use App\Domain\Logic\Service\EntryExitCreationLogic;
use App\Domain\Logic\Service\EntryExitInitializeLogic;
use App\Domain\Logic\Service\EntryExitUpdateLogic;
use App\Domain\Logic\Service\Impl\EntryExitUpdateLogicImpl;
use App\Domain\Logic\Validation\EntryExitCreateValidation;
use App\Domain\Logic\Validation\EntryExitUpdateeValidation;
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

    private EntryExitUpdateLogic $updateLogic;

    private EntryExitInitializeLogic $initializeLogic;

    private NumberingRepository $numberRepository;

    private StockService $stockService;

    public function __construct(
        EntryExitCreationLogic $logic, 
        NumberingRepository $numberRepository,
        StockService $stockService,
        EntryExitInitializeLogic $initializeLogic,
        EntryExitUpdateLogic $updateLogic)
    {
        $this->createtionLogic = $logic;
        $this->numberRepository = $numberRepository;
        $this->stockService = $stockService;
        $this->initializeLogic = $initializeLogic;
        $this->updateLogic = $updateLogic;
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


    public function getAll()
    {
        return $this->initializeLogic->getAll();
    }

    public function getByEntryExitId(int $id)
    {
        return $this->initializeLogic->findById($id);
    }

    // クラス分割したい
    public function update(Request $request)
    {
   
        // 元の伝票を確保しておく
        $oldSlip = $this->updateLogic->getOldSlip(intval($request->slipno));

        // 入力された情報で伝票情報を作成する
        $slip = new EntryExitSlip();
        $slip->setEntryExitId($request->slipno);        
        $slip->setSlipDiv($request->slipdiv);
        $slip->setSlipDate(new Carbon($request->slipdate));
        $slip->setUpdateUser("testuser");

        $detail = new EntryExitDetail();
        $detail->setEntryExitNo($request->slipno);
        $detail->setDetailNo(1);
        $detail->setDetailDiv($request->detaildiv);
        $detail->setCount($request->count);
        $detail->setUnit($request->unit);
        $detail->setItemName($request->itemname);
        $detail->setwarehouseName($request->warehousename);
        $slip->safeAddDetail($detail);


        $validationLogic = new EntryExitUpdateeValidation($slip,$oldSlip);
        $validationLogic->execute();

    
        // 在庫のロジックが少し複雑になる

        // 個数

        //　個数の計算

        // 基本的には品目と倉庫の変更はだめ→削除してください。

        //　倉庫と品目を変更した場合、元の個数をマイナスかプラスか計算して在庫に反映する

        $this->updateLogic->update($slip);

        
    }

}
