<?php

namespace App\Domain\Service\Impl;

use App\Domain\ComboItem\ItemCombobox;
use App\Domain\Repository\ItemRepository;
use App\Domain\Repository\WarehouseRepository;
use App\Domain\Service\EntryExitComboboxService;

class EntryExitComboboxServiceImpl implements EntryExitComboboxService{


    private ItemRepository $itemRepository;

    private WarehouseRepository $warehouseRepository;

    public function __construct(ItemRepository $itemRepository, WarehouseRepository $warehouseRepository)
    {
        $this->itemRepository = $itemRepository;
        $this->warehouseRepository = $warehouseRepository;
    }

    public function getEntryExitCombobox(){

        $items = $this->itemRepository->getAll();

        $warehouses = $this->warehouseRepository->getAll();

        return new ItemCombobox($items, $warehouses);
    }

}