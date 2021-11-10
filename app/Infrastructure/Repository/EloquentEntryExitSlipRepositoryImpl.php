<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Entity\EntryExitSlip;
use App\Domain\Repository\EntryExitSlipRepository;
use App\Models\EntryExitSlip as ModelsEntryExitSlip;

class EloquentEntryExitSlipRepositoryImpl implements EntryExitSlipRepository{
    
    public function create(EntryExitSlip $slip)
    {
        $eloquentSlip = new ModelsEntryExitSlip();
        $eloquentSlip->entry_exit_id = $slip->getEntryExitId();
        $eloquentSlip->slip_date = $slip->getSlipDate();
        $eloquentSlip->slip_div = $slip->getSlipDiv();
        $eloquentSlip->update_user = $slip->getUpdateUser();
        $eloquentSlip->save();
    }

    public function getAll()
    {

    }
}
