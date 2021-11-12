<?php

namespace App\Domain\Logic\Service;

interface EntryExitInitializeLogic
{
    public function getAll();

    public function findById(int $id);
}