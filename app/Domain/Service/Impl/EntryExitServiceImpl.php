<?php

namespace App\Domain\Service\Impl;

use App\Domain\Dto\StockDto;
use App\Domain\Logic\Service\EntryExitCreationLogic;
use App\Domain\Logic\Service\EntryExitDeleteLogic;
use App\Domain\Logic\Service\EntryExitInitializeLogic;
use App\Domain\Logic\Service\EntryExitUpdateLogic;
use App\Domain\Logic\Validation\EntryExitCreateValidation;
use App\Domain\Logic\Validation\EntryExitUpdateeValidation;
use App\Domain\Model\Entity\EntryExitDetail;
use App\Domain\Model\Entity\EntryExitSlip;
use App\Domain\Repository\EntryExitSlipRepository;
use App\Domain\Repository\NumberingRepository;
use App\Domain\Service\EntryExitService;
use App\Domain\Service\StockService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class EntryExitServiceImpl implements EntryExitService
{

    private EntryExitCreationLogic $createtionLogic;

    private EntryExitUpdateLogic $updateLogic;

    private EntryExitDeleteLogic $deleteLogic;

    private EntryExitSlipRepository $entryExitSlipRepository;

    private EntryExitInitializeLogic $initializeLogic;

    private NumberingRepository $numberRepository;

    private StockService $stockService;

    public function __construct(
        EntryExitCreationLogic $logic, 
        NumberingRepository $numberRepository,
        StockService $stockService,
        EntryExitInitializeLogic $initializeLogic,
        EntryExitUpdateLogic $updateLogic,
        EntryExitDeleteLogic $deleteLogic,
        EntryExitSlipRepository $entryExitSlipRepository
        )
    {
        $this->createtionLogic = $logic;
        $this->numberRepository = $numberRepository;
        $this->stockService = $stockService;
        $this->initializeLogic = $initializeLogic;
        $this->updateLogic = $updateLogic;
        $this->deleteLogic = $deleteLogic;
        $this->entryExitSlipRepository = $entryExitSlipRepository;
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
        $slip->setUpdateUser(Auth::id());

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
        return $this->entryExitSlipRepository->findById($id);
    }

    // クラス分割したい
    public function update(Request $request)
    {
   
        // 元の伝票を確保しておく
        $oldSlip = $this->entryExitSlipRepository->findById(intval($request->slipno));

        // 入力された情報で伝票情報を作成する
        $slip = new EntryExitSlip();
        $slip->setEntryExitId($request->slipno);        
        $slip->setSlipDiv($request->slipdiv);
        $slip->setSlipDate(new Carbon($request->slipdate));
        $slip->setUpdateUser($request->user()->id); // TODO 画面側にユーザーIDを保持

        $detail = new EntryExitDetail();
        $detail->setEntryExitNo($request->slipno);
        $detail->setDetailNo(1);
        $detail->setDetailDiv($request->detaildiv);
        $detail->setCount($request->count);
        $detail->setUnit($request->unit);
        $detail->setItemName($request->itemname);
        $detail->setwarehouseName($request->warehousename);
        $slip->safeAddDetail($detail);

        // TODO なんかクラス分割か何か
        /*
        if($request->user()->cannot('update',$slip))
        {
            dd("更新できませんでした");
        }
        */
        if(!Gate::allows("update-slip",$slip)){
            dd("更新できませんでした");
        }

        $validationLogic = new EntryExitUpdateeValidation($slip,$oldSlip);
        $validationLogic->execute();

    
        // 在庫のロジックが少し複雑になる
        foreach($oldSlip->getDetails() as $oldDetail)
        {

            // 現状は明細は1個であるのでロジックを追加せず処理して動きを見ます
            $oldStockDto = new StockDto($oldDetail->getItemName(),$oldDetail->getWarehouseName(), $oldDetail->getCount());

            // 新しい明細情報
            $newStockDto = new StockDto($detail->getItemName(), $detail->getWarehouseName(), $detail->getCount());
            $this->stockService->changeUpdate($newStockDto,$oldStockDto);
        }


        $this->updateLogic->update($slip);
    }


    public function delete(int $id)
    {
        //　伝票情報を取得する
        $slip = $this->entryExitSlipRepository->findById($id);
        
        foreach($slip->getDetails() as $detail)
        {
            // dtoの作成
            $stockDto = new StockDto($detail->getItemName(),$detail->getWarehouseName(), $detail->getCount());
            $this->stockService->deleteUpdate($stockDto);
        }
        // 伝票と明細を削除する
        $this->deleteLogic->delete($slip);

    }


}
