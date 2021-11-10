<?php

namespace App\Domain\Logic\Validation;

use App\Domain\Logic\Rule\EntryExit\TransactionCombinationRule;
use App\Domain\Logic\Rule\Rule;
use App\Domain\Model\Entity\EntryExitSlip;

use function PHPUnit\Framework\isNull;

class EntryExitCreateValidation
{

    private array $rules = array();

    private EntryExitSlip $slip;

    public function __construct(EntryExitSlip $slip)
    {
        $this->slip = $slip;

        array_push($this->rules,[
            new TransactionCombinationRule($slip),
        ]);
    }

    public function execute()
    {

        // TODO これはまずいので実装方法があり次第修正する
        $rule = new TransactionCombinationRule($this->slip);
        $rule->vaild();

        foreach($this->rules as $rule)
        {

            // Javaのようにできないので一旦、保留の処理になっています。
            // $rule->vaild();
        }
    }


}
