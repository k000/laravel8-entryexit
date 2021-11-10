<?php

namespace App\Domain\Logic\Rule\EntryExit;

use App\Domain\Logic\Rule\Rule;

class TransactionCombinationRule implements Rule
{

    private string $slipDiv;

    private string $detailDiv;

    public function __construct(string $slipdiv, string $detaildiv)
    {
        $this->slipDiv = $slipdiv;
        $this->detailDiv = $detaildiv;
    }

    public function vaild()
    {
        if($this->slipDiv === "入庫" && $this->detailDiv === "入庫" 
            || $this->slipDiv === "入庫" && $this->detailDiv === "返品")
        {
            return true;
        }
        if($this->slipDiv === "出庫" && $this->detailDiv === "出庫" 
            || $this->slipDiv === "出庫" && $this->detailDiv === "破棄")
        {
            return true;
        }
        return false;
    }

}