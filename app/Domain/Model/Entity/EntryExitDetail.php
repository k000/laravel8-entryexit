<?php

namespace App\Domain\Model\Entity;

class EntryExitDetail extends Detail{
    private int $entryexitNo;

    private string $detailDiv;

    private int $itemId;

    private string $itemName;

    private int $warehouseId;

    private string $warehouseName;

    private int $count;

    private string $unit;

    public function setEntryExitNo(int $no)
    {
        $this->entryexitNo = $no;
    }

    public function getEntryExitNo()
    {
        return $this->entryexitNo;
    }

    public function setDetailDiv(string $div)
    {
        $this->detailDiv = $div;
    }

    public function getDetailDiv()
    {
        return $this->detailDiv;
    }

    public function setCount(int $count)
    {
        $this->count = $count;
    }

    public function getCount()
    {
        return $this->count;
    }

    public function setUnit(string $unit)
    {
        $this->unit = $unit;
    }

    public function getUnit()
    {
        return $this->unit;
    }

    public function setItemName(string $name)
    {
        $this->itemName = $name;
    }

    public function getItemName()
    {
        return $this->itemName;
    }

    public function setwarehouseName(string $name)
    {
        $this->warehouseName = $name;
    }

    public function getWarehouseName()
    {
        return $this->warehouseName;
    }

    /**
     * 明細区分と数量の整合性を検証します
     */
    public function isExpectedCount(): bool
    {
        // todo refactor use types
        if($this->detailDiv === "入庫" || $this->detailDiv === "返品")
        {
            if($this->count <= 0){
                return false;
            }
        }

        if($this->detailDiv === "出庫" || $this->detailDiv === "破棄")
        {
            if($this->count >= 0){
                return false;
            }
        }

        return true;

    }


}