<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Entity\Warehouse;
use App\Domain\Repository\WarehouseRepository;
use App\Models\Warehouse as ModelsWarehouse;

class EloquentWarehouseRepositoryImpl implements WarehouseRepository{
    
    public function create(Warehouse $warehouse){
        $eloquentWarehouse = new ModelsWarehouse();
        $eloquentWarehouse->warehouse_name = $warehouse->getName();//カラム名に合わせる
        $eloquentWarehouse->save();
    }
}
