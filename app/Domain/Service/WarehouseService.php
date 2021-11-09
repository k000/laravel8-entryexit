<?php

namespace App\Domain\Service;

use App\Http\Requests\StoreWarehouseRequest;

interface WarehouseService
{
    public function create(StoreWarehouseRequest $request);
}
