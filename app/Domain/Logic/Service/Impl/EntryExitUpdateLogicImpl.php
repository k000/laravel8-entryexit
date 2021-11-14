<?php

namespace App\Domain\Logic\Service\Impl;

use App\Domain\Logic\Service\EntryExitUpdateLogic;
use App\Domain\Model\Entity\EntryExitSlip;
use App\Domain\Repository\EntryExitDetailRepository;
use App\Domain\Repository\EntryExitSlipRepository;

class EntryExitUpdateLogicImpl implements EntryExitUpdateLogic
{

    private EntryExitSlipRepository $slipRepository;

    private EntryExitDetailRepository $detailRepository;

    public function __construct(EntryExitSlipRepository $slipRespository, EntryExitDetailRepository $detailRepository)
    {
        $this->slipRepository = $slipRespository;
        $this->detailRepository = $detailRepository;
    }

    public function update(EntryExitSlip $slip)
    {
        // 伝票の登録
        $this->slipRepository->update($slip);

         // 明細のデリートインサート
        foreach($slip->getDetails() as $detail)
        {
            $this->detailRepository->delete($detail->getEntryExitNo());
            $this->detailRepository->create($detail);
        }
    }  

}