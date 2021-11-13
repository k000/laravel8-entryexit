<?php

namespace App\Domain\Repository;

use App\Domain\Model\Entity\EntryExitDetail;


interface EntryExitDetailRepository
{
    public function create(EntryExitDetail $detail);

    public function delete(int $enteryexitId);

    public function getAll();

}