<?php

namespace App\Domain\Repository;

use App\Domain\Model\Entity\Item;

interface ItemRepository
{
    public function create(Item $item);

    public function getAll();
}