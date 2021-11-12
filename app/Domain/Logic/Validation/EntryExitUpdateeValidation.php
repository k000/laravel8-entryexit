<?php

namespace App\Domain\Logic\Validation;

use App\Domain\Logic\Rule\EntryExit\SlipDivRule;
use App\Domain\Logic\Rule\EntryExit\TransactionCombinationRule;
use App\Domain\Logic\Rule\EntryExit\VaildCountRule;
use App\Domain\Logic\Rule\Rule;
use App\Domain\Model\Entity\EntryExitSlip;
use Illuminate\Support\Facades\Redirect;

class EntryExitUpdateeValidation
{

    private array $rules = array();

    public function __construct(EntryExitSlip $slip,EntryExitSlip $oldSlip)
    {
        $this->addRule(new SlipDivRule($slip,$oldSlip));
        $this->addRule(new TransactionCombinationRule($slip));
        $this->addRule(new VaildCountRule($slip));
    }

    public function execute()
    {
        $result = array();

        foreach($this->rules as $rule)
        {
            $vaildResult = $rule->vaild();
            $result = [...$result, ...$vaildResult];
        }

        if(count($result) !== 0)
        {
            Redirect::route('entryexitcreate')->with(["messages" => $result])->withErrors(['result' => "エラーがあります"])->withInput()->throwResponse();;
        }

    }


    private function addRule(Rule $rule)
    {
        array_push($this->rules,$rule);
    }

}