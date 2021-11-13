<?php

namespace App\Domain\Service;

use App\Domain\Dto\StockDto;

interface StockService
{
    public function update(StockDto $dto);

    public function changeUpdate(StockDto $newDto, StockDto $oldDto);

    public function deleteUpdate(StockDto $dto);
}
