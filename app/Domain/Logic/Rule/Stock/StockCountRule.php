<?php

namespace App\Domain\Logic\Rule\Stock;

use App\Domain\Logic\Rule\Rule;
use App\Domain\Model\Entity\Stock;

class StockCountRule implements Rule
{

    private Stock $stock;

    public function __construct(Stock $stock)
    {
        $this->stock = $stock;
    }

    public function vaild(): array
    {

        $messages = array();

        if(!$this->stock->canExit())
        {
            array_push($messages,["在庫が足りません"]);
        }
        
        return $messages;
    }

}