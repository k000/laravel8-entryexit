<?php

namespace App\Domain\Model\Entity;


class Stock
{
    private string $itemName;

    private string $warehouseName;

    private int $count;

    public function canExit(int $exitCount)
    {
        if($this->count - $exitCount < 0)
        {
            return false;
        }
        return true;
    }

    public function setItenName(string $name)
    {
        $this->itemName = $name;
    }

    public function getItemName()
    {
        return $this->itemName;
    }

    
    public function setWarehouseName(string $name)
    {
        $this->warehouseName = $name;
    }

    public function getWarehouseName()
    {
        return $this->warehouseName;
    }

    public function setCount(string $count)
    {
        $this->count = $count;
    }

    public function getCount()
    {
        return $this->count;
    }


}
