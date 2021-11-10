<?php

namespace App\Domain\Service\Impl;

use App\Domain\Logic\Service\EntryExitCreationLogic;
use App\Domain\Model\Entity\EntryExitDetail;
use App\Domain\Model\Entity\EntryExitSlip;
use App\Domain\Service\EntryExitService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EntryExitServiceImpl implements EntryExitService
{


    private EntryExitCreationLogic $createtionLogic;

    public function __construct(EntryExitCreationLogic $logic)
    {
        $this->createtionLogic = $logic;
    }

    public function create(Request $request)
    {

        // TODO create処理を切り出し
        // モデルの作成
        $slip = new EntryExitSlip();
        $slip->setEntryExitId(999);        
        $slip->setSlipDiv($request->slipdiv);
        $slip->setSlipDate(new Carbon($request->slipdate));
        $slip->setUpdateUser("testuser");

        $detail = new EntryExitDetail();
        $detail->setEntryExitNo(999);
        $detail->setDetailNo(1);
        $detail->setDetailDiv($request->detaildiv);
        $detail->setCount($request->count);
        $detail->setUnit($request->unit);
        $detail->setItemName($request->itemname);
        $detail->setwarehouseName($request->warehousename);

        $slip->safeAddDetail($detail);

        // ドメインロジックバリデーション呼出し

        // 在庫数のチェック

        // 採番処理

        // 永続化処理
        $this->createtionLogic->create($slip);


    }

}
