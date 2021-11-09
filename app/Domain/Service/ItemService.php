<?php

namespace App\Domain\Service;

use App\Http\Requests\StoreItemRequest;

interface ItemService
{
    public function create(StoreItemRequest $request);
}
