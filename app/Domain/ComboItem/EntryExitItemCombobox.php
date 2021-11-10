<?php

namespace App\Domain\ComboItem;

/**
 * コンボボックスに表示する値の入れ物。
 */
class EntryExitItemCombobox{

    private array $items;

    private array $warehouses;

    private array $slipDivs;

    private array $detailDivs;

    public function __construct(array $items, array $warehouses, array $slipDivs, array $detailDivs)
    {
        $this->items = $items;
        $this->warehouses = $warehouses;
        $this->slipDivs = $slipDivs;
        $this->detailDivs = $detailDivs;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function getWarehouses()
    {
        return $this->warehouses;
    }

    public function getSlipDivs()
    {
        return $this->slipDivs;
    }

    public function getDetailDivs()
    {
        return $this->detailDivs;
    }
    
}