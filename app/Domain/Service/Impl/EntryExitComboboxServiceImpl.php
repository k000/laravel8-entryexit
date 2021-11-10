<?php

namespace App\Domain\Service\Impl;

use App\Domain\ComboItem\EntryExitItemCombobox;
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

        // 簡略化のため一旦値をべた書きしています。
        $slipDivs = ["入庫","出庫"];

        $detailDivs = ["入庫","返品","出庫","破棄"];

        // Warning コードの変更範囲が大きくなる
        return new EntryExitItemCombobox($items, $warehouses, $slipDivs, $detailDivs);
    }

}