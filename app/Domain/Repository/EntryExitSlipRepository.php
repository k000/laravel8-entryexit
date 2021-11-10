<?php

namespace App\Domain\Repository;

use App\Domain\Model\Entity\EntryExitSlip;

interface EntryExitSlipRepository
{
    public function create(EntryExitSlip $slip);

    public function getAll();
}