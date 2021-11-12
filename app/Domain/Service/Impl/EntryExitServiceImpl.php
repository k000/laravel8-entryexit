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

        // 在庫数のチェック

        // 在庫モデルを作成します。
        // DTO的なものを作りたい。（数量をマイナス登録したほうがよいのでは？）
        $stockDto = new StockDto($detail->getItemName(), $detail->getWarehouseName(), $detail->getCount());
        $this->stockService->update($stockDto);

        dd("tourokumade oK!!!!");

        // 在庫モデルをUpdateに引き渡します。
        // updateで検証を行います。
            // 検証内容は、在庫モデルの数量が出庫数で-になったらだめ

            // 出庫をupdateします。

        // Lets gooo!!! buuuuooooonnn!!!
        
        // stockは既にある場合もあれば無い場合もあるので別途取得します。


        // 永続化処理
        $this->createtionLogic->create($slip);


    }

}
