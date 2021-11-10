<?php

namespace App\Domain\Logic\Validation;

use App\Domain\Logic\Rule\EntryExit\TransactionCombinationRule;
use App\Domain\Model\Entity\EntryExitSlip;

use function PHPUnit\Framework\isNull;

class EntryExitCreateValidation
{

    private array $rules = array();

    public function __construct(EntryExitSlip $slip)
    {
        array_push($this->rules,[
            new TransactionCombinationRule($slip),
        ]);
    }

    public function execute()
    {
        foreach($this->rules as $rule)
        {
            $rule->vaild();
        }
    }


}
