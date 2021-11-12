<?php

namespace App\Domain\Model\Entity;


class Stock
{

    private int $id;

    private string $itemName;

    private string $warehouseName;

    private int $count;

    private int $scheduleCount;

    public function canExit()
    {
        if($this->count + ($this->scheduleCount) < 0)
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

    public function setScheduleCount(int $count)
    {
        $this->scheduleCount = $count;
    }

    // todo refactor
    public function getCurrentCount()
    {
        return $this->count;
    }

    // 実在庫と予定在庫（仮）を足したもの
    public function getWillCount()
    {
        return $this->count + $this->scheduleCount;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

}
