<?php

namespace App\Domain\ComboItem;

class ItemCombobox{

    private array $items;

    private array $warehouses;

    public function __construct(array $items, array $warehouses)
    {
        $this->items = $items;
        $this->warehouses = $warehouses;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function getWarehouses()
    {
        return $this->warehouses;
    }
    
}