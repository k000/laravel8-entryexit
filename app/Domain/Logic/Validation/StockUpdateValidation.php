<?php

namespace App\Domain\Logic\Validation;

use App\Domain\Logic\Rule\Rule;
use App\Domain\Logic\Rule\Stock\StockCountRule;
use App\Domain\Model\Entity\Stock;
use Illuminate\Support\Facades\Redirect;

class StockUpdateValidation{

    private array $rules = array();

    public function __construct(Stock $stock)
    {
        $this->addRule(new StockCountRule($stock));
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