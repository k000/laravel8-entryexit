<?php

namespace App\Domain\Logic\Validation;

use App\Domain\Logic\Rule\EntryExit\TransactionCombinationRule;
use App\Domain\Model\Entity\EntryExitSlip;
use Illuminate\Support\Facades\Redirect;

class EntryExitCreateValidation
{

    private array $rules = array();

    private array $message = array();

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

        // TODO 実装方法があり次第修正する
        $rule = new TransactionCombinationRule($this->slip);
        $vaildResult = $rule->vaild();

        $result = array_merge($this->message,$vaildResult);

        foreach($this->rules as $rule)
        {

            // Javaのようにできないので一旦、保留の処理になっています。
            // $vaildResult = $rule->vaild();
            //$result = array_merge($this->message,$vaildResult);
        }

        if(count($result) !== 0)
        {
            Redirect::route('entryexitcreate')->with(["messages" => $result])->withErrors(['result' => "エラーがあります"])->withInput()->throwResponse();;
        }

        dd("在庫数のチェックへ");

    }

}