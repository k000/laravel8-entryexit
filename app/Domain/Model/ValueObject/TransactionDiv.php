<?php

/**
 * 考え中
 * 使ってないクラス
 */

namespace App\Domain\Model\ValueObject;

abstract class TransactionDiv{

    protected array $values;

    final public function validate()
    {
        if($this->rule())
        {
            return true;
        } else {
            return false;
        }
    }
    
    public abstract static function make();

    public abstract function rule();

}
