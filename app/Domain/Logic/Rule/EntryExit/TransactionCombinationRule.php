<?php

namespace App\Domain\Logic\Rule\EntryExit;

use App\Domain\Logic\Rule\Rule;
use App\Domain\Model\Entity\EntryExitSlip;

class TransactionCombinationRule implements Rule
{

    private EntryExitSlip $slip;

    public function __construct(EntryExitSlip $slip)
    {
        $this->slip = $slip;
    }

    public function vaild(): array
    {

        $messages = array();

        if($this->slip->getSlipDiv() === "入庫")
        {
            foreach($this->slip->getDetails() as $detail)
            {
                if($detail->getDetailDiv() === "出庫" || $detail->getDetailDiv() === "破棄"){
                    array_push($messages,["伝票と明細の取引区分が不正です。"]);
                }
            }
        }

        if($this->slip->getSlipDiv() === "出庫")
        {
            foreach($this->slip->getDetails() as $detail)
            {
                if($detail->getDetailDiv() === "入庫" || $detail->getDetailDiv() === "返品"){
                    array_push($messages,["伝票と明細の取引区分が不正です。"]);
                }
            }
        }

        return $messages;

    }

}