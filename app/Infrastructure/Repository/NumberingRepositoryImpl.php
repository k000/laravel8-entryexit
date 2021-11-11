<?php

namespace App\Infrastructure\Repository;

use App\Domain\Repository\NumberingRepository;
use App\Models\ManageNumber;
use Exception;
use Illuminate\Support\Facades\DB;

class NumberingRepositoryImpl implements NumberingRepository
{
    public function getId(string $appName)
    {
        try{
            DB::beginTransaction();
            $model = ManageNumber::where('application_name', $appName)->lockForUpdate()->first();

            // 値を取得して更新します。
            $newNo = strval($model->number) + 1;

            $model->number = $newNo;
            $model->save();
            DB::commit();

            return $newNo;

        } catch (Exception $e) {
            DB::rollback();
            throw new Exception("他のユーザーが処理をしています。");
        }
    }

}