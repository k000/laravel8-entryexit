<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Entity\Warehouse;
use App\Domain\Repository\WarehouseRepository;
use App\Models\Warehouse as ModelsWarehouse;

class EloquentWarehouseRepositoryImpl implements WarehouseRepository{
    
    public function create(Warehouse $warehouse){
        $eloquentWarehouse = new ModelsWarehouse();
        $eloquentWarehouse->warehouse_name = $warehouse->getName();
        $eloquentWarehouse->save();
    }

    public function getAll()
    {
        $eloquentWarehouses = ModelsWarehouse::all();
        $warehouses = array();
        foreach($eloquentWarehouses as $eloquentWarehouse)
        {
            $warehouse = new Warehouse($eloquentWarehouse->warehouse_name);
            array_push($warehouses,$warehouse);
        }
        return $warehouses;
    }
}
