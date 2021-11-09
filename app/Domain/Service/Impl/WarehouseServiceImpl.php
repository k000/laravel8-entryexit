<?php

namespace App\Domain\Service\Impl;

use App\Domain\Model\Entity\Warehouse;
use App\Domain\Repository\WarehouseRepository;
use App\Domain\Service\WarehouseService;
use App\Http\Requests\StoreWarehouseRequest;

class WarehouseServiceImpl implements WarehouseService
{

    private WarehouseRepository $repository;

    public function __construct(WarehouseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(StoreWarehouseRequest $request)
    {

        $warehouse = new Warehouse($request->name);

        $this->repository->create($warehouse);

    }

}
