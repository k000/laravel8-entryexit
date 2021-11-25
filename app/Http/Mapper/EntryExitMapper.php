<?php

namespace App\Http\Mapper;

use App\Domain\Model\Entity\EntryExitDetail;
use App\Domain\Model\Entity\EntryExitSlip;
use App\Http\ViewModel\EntryExitDetailViewModel;
use App\Http\ViewModel\EntryExitViewModel;


/**
 * 共通クラスなど検討
 * ジェネリクスがないので一旦このまま
 */
class EntryExitMapper
{

    /**
     * 伝票リストに対する変換を行う
     * 全件取得などではこちら
     * 
     */
    public function toViewModels(array $slips)
    {

        // 伝票の変換
        // 第一引数で型の指定、第二引数で配列　とすることで型安全？
        $models =  array_map(
            function(EntryExitSlip $slip)
            {
                return $this->mapSlip($slip);
            }, $slips
        );

        // あえて変数に代入させてます（記録のため）
        return $models;
    }


    /**
     * 汎用的に利用する
     */
    private function mapDetail(array $details)
    {
        return array_map(
            function(EntryExitDetail $detail)
            {
                $model = new EntryExitDetailViewModel();
                $model->detailDiv = $detail->getDetailDiv();
                $model->itemName = $detail->getItemName();
                $model->warehouseName = $detail->getWarehouseName();
                $model->count = $detail->getCount();
                $model->unit = $detail->getUnit();
                return $model;
            }, $details
        );
    }

    /**
     * 伝票1件に対する変換を行う
     */
    public function toViewModel(EntryExitSlip $slip)
    {
        return $this->mapSlip($slip);
    }

    /**
     * 伝票の変換処理
     */
    private function mapSlip(EntryExitSlip $slip): EntryExitViewModel
    {
        $model = new EntryExitViewModel();
            $model->entryexitId = $slip->getEntryExitId();
            $model->slipDiv = $slip->getSlipDiv();
            $model->updateUser = $slip->getUpdateUser();
            $model->slipDate = $slip->getSlipDate();
            // 明細の取得
            $details = $this->mapDetail($slip->getDetails());
            $model->details = $details;
        return $model;
    }
}