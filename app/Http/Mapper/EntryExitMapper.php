<?php

namespace App\Http\Mapper;

use App\Domain\Model\Entity\EntryExitSlip;
use App\Http\ViewModel\EntryExitViewModel;

/**
 * 共通クラスなど検討
 * ジェネリクスがないので一旦このまま
 */
class EntryExitMapper
{

    /**
     * 伝票リストに対する変換を行う
     * 
     */
    public function toViewModels(array $slips)
    {
        // 伝票の変換
        // コールバックの中でループしてるのが気持ち悪い
        // 第一引数で型の指定、第二引数で配列　とすることで型安全？
        $models = array_map(
            function(EntryExitSlip $slip)
            {
                // 明細の取得
                foreach($slip->getDetails() as $detail)
                {

                }

            }, $slips
        );
    }

    /**
     * 伝票1件に対する変換を行う
     */
    public function toViewModel(EntryExitSlip $slip)
    {
        $model = new EntryExitViewModel();
        
        return $model;
    }
}