<?php

namespace App\Domain\Logic\Validation;

use App\Domain\Logic\Rule\EntryExit\TransactionCombinationRule;
use App\Domain\Logic\Rule\EntryExit\VaildCountRule;
use App\Domain\Logic\Rule\Rule;
use App\Domain\Model\Entity\EntryExitSlip;
use Illuminate\Support\Facades\Redirect;

class EntryExitCreateValidation
{

    private array $rules = array();

    public function __construct(EntryExitSlip $slip)
    {
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



    //　基底切り出しなどしても良い
    /**
     * 型の限定を行う。
     * こうしないとarray型からメソッド呼出しを行う行為になってしまう(array->function())
     */
    private function addRule(Rule $rule)
    {
        array_push($this->rules,$rule);
    }

}