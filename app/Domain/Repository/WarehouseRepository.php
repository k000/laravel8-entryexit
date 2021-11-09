<?php

namespace App\Domain\Repository;

use App\Domain\Model\Entity\Warehouse;

interface WarehouseRepository
{
    public function create(Warehouse $warehouse);

    public function getAll();
}