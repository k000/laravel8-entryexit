<?php

namespace App\Domain\Logic\Service;

use App\Domain\Model\Entity\EntryExitSlip;


interface EntryExitCreationLogic
{
    public function create(EntryExitSlip $slip);

}