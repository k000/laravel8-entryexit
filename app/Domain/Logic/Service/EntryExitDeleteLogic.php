<?php

namespace App\Domain\Logic\Service;

use App\Domain\Model\Entity\EntryExitSlip;

interface EntryExitDeleteLogic
{
    public function delete(EntryExitSlip $slip);
}