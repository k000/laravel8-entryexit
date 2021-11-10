<?php

namespace App\Domain\Logic\Service\Impl;

use App\Domain\Logic\Service\EntryExitCreationLogic;
use App\Domain\Model\Entity\EntryExitSlip;
use App\Domain\Repository\EntryExitDetailRepository;
use App\Domain\Repository\EntryExitSlipRepository;

class EntryExitCreationLogicImpl implements EntryExitCreationLogic
{

    private EntryExitSlipRepository $slipRepository;

    private EntryExitDetailRepository $detailRepository;


    public function __construct(EntryExitSlipRepository $slipRespository, EntryExitDetailRepository $detailRepository)
    {
        $this->slipRepository = $slipRespository;
        $this->detailRepository = $detailRepository;
    }


    public function create(EntryExitSlip $slip)
    {

        // 伝票の保存
        $this->slipRepository->create($slip);

        // 更新時のみ明細の削除
        // $this->detailRepository->delete($slip->getEntryExitId());

        // 明細の保存
        foreach($slip->getDetails() as $detail)
        {
            $this->detailRepository->create($detail);
        }
    }
}