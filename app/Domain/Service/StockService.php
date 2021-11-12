<?php

namespace App\Domain\Service;

use App\Domain\Dto\StockDto;

interface StockService
{
    public function update(StockDto $dto);
}
