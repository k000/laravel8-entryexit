<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Entity\EntryExitDetail;
use App\Domain\Repository\EntryExitDetailRepository;
use App\Models\EntryExitDetail as ModelsEntryExitDetail;

class EloquentEntryExitDetailRepositoryImpl implements EntryExitDetailRepository{
    
    // TODO itemidなどは削除する
    public function create(EntryExitDetail $detail)
    {
        $eloquentDetail = new ModelsEntryExitDetail();
        $eloquentDetail->entry_exit_id = $detail->getEntryExitNo();
        $eloquentDetail->detail_no = $detail->getDetailNo();
        $eloquentDetail->detail_div = $detail->getDetailDiv();
        $eloquentDetail->item_id = 10;
        $eloquentDetail->item_name = $detail->getItemName();
        $eloquentDetail->warehouse_id = 10;
        $eloquentDetail->warehouse_name = $detail->getWarehouseName();
        $eloquentDetail->count = $detail->getCount();
        $eloquentDetail->unit = $detail->getUnit();
        $eloquentDetail->save();
    }

    public function delete(int $entryexitId)
    {
        $eloquentDetail = ModelsEntryExitDetail::where('entry_exit_id', $entryexitId);
        $eloquentDetail->delete();
    }

    // TODO 削除
    public function getAll()
    {

    }
}
