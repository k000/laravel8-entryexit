<?php
/**
 * 考え中
 * 使ってないクラス
 */
namespace App\Domain\Model\ValueObject;

class EntryExitTransactionDiv extends TransactionDiv{

    public static function make()
    {
        $instance = new EntryExitTransactionDiv();
        
        return $instance;
    }

    public function rule()
    {
        // if($this->)
    }

}
