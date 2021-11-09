<?php

namespace App\Http\Controllers;

use App\Domain\Service\WarehouseService;
use App\Http\Requests\StoreWarehouseRequest;

class WarehouseController extends Controller
{
    
    private WarehouseService $service;

    public function __construct(WarehouseService $service)
    {
        $this->service = $service;
    }

    public function store(StoreWarehouseRequest $request)
    {
        $this->service->create($request);
    }
}
