<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Entity\Item;
use App\Domain\Repository\ItemRepository;
use App\Models\Item as ModelsItem;

class EloquentItemRepositoryImpl implements ItemRepository{
    
    public function create(Item $item){
        $eloquentItem = new ModelsItem();
        $eloquentItem->item_name = $item->getName();//カラム名に合わせる
        $eloquentItem->price = $item->getPirce();
        $eloquentItem->save();
    }
}
