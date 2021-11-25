<?php

namespace App\Http\ViewModel;

class EntryExitDetailViewModel
{
    public string $detailDiv;

    public string $itemName;

    public string $warehouseName;

    public int $count;

    public string $unit;

    // View側の修正ができたら消す
    public function getDetailDiv()
    {
        return $this->detailDiv;
    }
    public function getCount()
    {
        return $this->count;
    }
    public function getUnit()
    {
        return $this->unit;
    }
    public function getItemName()
    {
        return $this->itemName;
    }
    public function getWarehouseName()
    {
        return $this->warehouseName;
    }

}