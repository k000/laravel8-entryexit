<?php

namespace App\Domain\Logic\Service;

use App\Domain\Model\Entity\EntryExitSlip;


interface EntryExitUpdateLogic
{

    public function getOldSlip(int $entryexitId);

    public function update(EntryExitSlip $slip);
}