<?php

namespace App\Domain\Logic\Rule\EntryExit;

use App\Domain\Logic\Rule\Rule;
use App\Domain\Model\Entity\EntryExitSlip;

class SlipDivRule implements Rule
{

    private EntryExitSlip $slip;

    private EntryExitSlip $oldSlip;

    public function __construct(EntryExitSlip $slip, EntryExitSlip $oldSlip)
    {
        $this->slip = $slip;
        $this->oldSlip = $oldSlip;
    }

    public function vaild(): array
    {

        $messages = array();

        if($this->slip->getSlipDiv() != $this->oldSlip->getSlipDiv())
        {
            array_push($messages,["伝票種別を変更することはできません。"]);
        }

        return $messages;
    }

}