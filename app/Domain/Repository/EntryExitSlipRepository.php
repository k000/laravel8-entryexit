<?php

namespace App\Domain\Repository;

use App\Domain\Model\Entity\EntryExitSlip;

interface EntryExitSlipRepository
{
    public function create(EntryExitSlip $slip);

    public function getAll();

    public function findById(int $id);

    public function update(EntryExitSlip $slip);

    public function delete(int $id);

}