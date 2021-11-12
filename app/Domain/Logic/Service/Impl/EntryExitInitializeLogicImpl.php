<?php

namespace App\Domain\Logic\Service\Impl;

use App\Domain\Logic\Service\EntryExitInitializeLogic;
use App\Domain\Repository\EntryExitDetailRepository;
use App\Domain\Repository\EntryExitSlipRepository;

class EntryExitInitializeLogicImpl implements EntryExitInitializeLogic
{

    private EntryExitSlipRepository $slipRepository;

    public function __construct(EntryExitSlipRepository $slipRespository, EntryExitDetailRepository $detailRepository)
    {
        $this->slipRepository = $slipRespository;
        $this->detailRepository = $detailRepository;
    }

    public function getAll()
    {
        // ドメインモデルを返却します。
        // この記載だとEloquentモデルに依存しがち
        return $this->slipRepository->getAll();

    }

    public function findById(int $id)
    {
        return $this->slipRepository->findById($id);
    }


}