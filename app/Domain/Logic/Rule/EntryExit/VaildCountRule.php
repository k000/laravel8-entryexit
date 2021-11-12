<?php

namespace App\Domain\Logic\Rule\EntryExit;

use App\Domain\Logic\Rule\Rule;
use App\Domain\Model\Entity\EntryExitSlip;

class VaildCountRule implements Rule
{

    private EntryExitSlip $slip;

    public function __construct(EntryExitSlip $slip)
    {
        $this->slip = $slip;
    }

    public function vaild(): array
    {

        $messages = array();

        foreach($this->slip->getDetails() as $detail)
        {
            if(!$detail->isExpectedCount())
            {
                array_push($messages,["明細区分と数量の整合性が不正です"]);
            }
        }

        return $messages;

    }

}