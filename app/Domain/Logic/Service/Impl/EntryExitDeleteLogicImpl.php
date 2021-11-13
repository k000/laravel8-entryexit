<?php

namespace App\Domain\Logic\Service\Impl;

use App\Domain\Logic\Service\EntryExitDeleteLogic;
use App\Domain\Model\Entity\EntryExitSlip;
use App\Domain\Repository\EntryExitDetailRepository;
use App\Domain\Repository\EntryExitSlipRepository;

class EntryExitDeleteLogicImpl implements EntryExitDeleteLogic
{

    private EntryExitSlipRepository $slipRepository;

    private EntryExitDetailRepository $detailRepository;


    public function __construct(EntryExitSlipRepository $slipRespository, EntryExitDetailRepository $detailRepository)
    {
        $this->slipRepository = $slipRespository;
        $this->detailRepository = $detailRepository;
    }

    public function delete(EntryExitSlip $slip)
    {

        $this->slipRepository->delete($slip->getEntryExitId());
        foreach($slip->getDetails() as $detail)
        {
            $this->detailRepository->delete($detail->getEntryExitNo());
        }

    }

}