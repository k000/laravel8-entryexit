<?php

namespace App\Domain\Logic\Validation;

use App\Domain\Logic\Rule\EntryExit\TransactionCombinationRule;

use function PHPUnit\Framework\isNull;

class EntryExistCreateValidation
{

    private EntryExistCreateValidation $instance;

    public static function getInstance()
    {
        if(isNull(self::$instance))
        {
            self::$instance = new self;
        }
        return self::$instance;
        
    }


    private array $rules;

    private function __construct()
    {
        array_push(self::$rules,[
            new TransactionCombinationRule("aaa","aaaa"),
        ]);
    }

    public function execute()
    {
        foreach(self::$rules as $rule)
        {
            $rule->vaild();
        }
    }


}
