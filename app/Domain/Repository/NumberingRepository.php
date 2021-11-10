<?php

namespace App\Domain\Repository;

interface NumberingRepository
{
    public function getId(string $appName);
}