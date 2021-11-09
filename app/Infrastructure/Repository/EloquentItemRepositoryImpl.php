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


    public function getAll()
    {
        $eloquentItems = ModelsItem::all();
        $items = array();
        foreach($eloquentItems as $eloquentItem)
        {
            $item = new Item($eloquentItem->item_name, $eloquentItem->price);
            array_push($items,$item);
        }
        return $items;
    }
}
