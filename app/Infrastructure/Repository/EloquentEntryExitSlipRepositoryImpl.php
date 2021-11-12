<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Entity\EntryExitDetail;
use App\Domain\Model\Entity\EntryExitSlip;
use App\Domain\Repository\EntryExitSlipRepository;
use App\Models\EntryExitSlip as ModelsEntryExitSlip;
use Carbon\Carbon;

class EloquentEntryExitSlipRepositoryImpl implements EntryExitSlipRepository{
    
    public function create(EntryExitSlip $slip)
    {
        $eloquentSlip = new ModelsEntryExitSlip();
        $eloquentSlip->entry_exit_id = $slip->getEntryExitId();
        $eloquentSlip->slip_date = $slip->getSlipDate();
        $eloquentSlip->slip_div = $slip->getSlipDiv();
        $eloquentSlip->update_user = $slip->getUpdateUser();
        $eloquentSlip->save();
    }


    public function getAll()
    {
        $eloquentSlips = ModelsEntryExitSlip::all();

        
        $result = array();

        foreach($eloquentSlips as $eloquentSlip)
        {
            $slip = new EntryExitSlip();
            $slip->setEntryExitId($eloquentSlip->entry_exit_id);
            $slip->setSlipDate(new Carbon($eloquentSlip->slip_date));
            $slip->setSlipDiv($eloquentSlip->slip_div);
            $slip->setUpdateUser($eloquentSlip->update_user);

            

            //　明細の設定
            foreach($eloquentSlip->details as $eloquentDetail)
            {
                $detail = new EntryExitDetail();
                $detail->setEntryExitNo($eloquentDetail->entry_exit_id);
                $detail->setDetailNo($eloquentDetail->detail_no);
                $detail->setDetailDiv($eloquentDetail->detail_div);
                $detail->setItemName($eloquentDetail->item_name);
                $detail->setwarehouseName($eloquentDetail->warehouse_name);
                $detail->setCount($eloquentDetail->count);
                $detail->setUnit($eloquentDetail->unit);

                $slip->safeAddDetail($detail);
            }
           
            array_push($result,$slip);
        }

        return $result;
    }

    public function findById(int $id)
    {
        $eloquentSlip = ModelsEntryExitSlip::where('entry_exit_id',$id)->first();

        // dry
        $slip = new EntryExitSlip();
        $slip->setEntryExitId($eloquentSlip->entry_exit_id);
        $slip->setSlipDate(new Carbon($eloquentSlip->slip_date));
        $slip->setSlipDiv($eloquentSlip->slip_div);
        $slip->setUpdateUser($eloquentSlip->update_user);

        foreach($eloquentSlip->details as $eloquentDetail)
        {
            $detail = new EntryExitDetail();
            $detail->setEntryExitNo($eloquentDetail->entry_exit_id);
            $detail->setDetailNo($eloquentDetail->detail_no);
            $detail->setDetailDiv($eloquentDetail->detail_div);
            $detail->setItemName($eloquentDetail->item_name);
            $detail->setwarehouseName($eloquentDetail->warehouse_name);
            $detail->setCount($eloquentDetail->count);
            $detail->setUnit($eloquentDetail->unit);

            $slip->safeAddDetail($detail);
        }

        return $slip;
    }


    public function update(EntryExitSlip $slip)
    {
        $eloquentSlip = ModelsEntryExitSlip::where('entry_exit_id',$slip->getEntryExitId())->first();
        $eloquentSlip->slip_date = $slip->getSlipDate();
        $eloquentSlip->slip_div = $slip->getSlipDiv();
        $eloquentSlip->update_user = $slip->getUpdateUser();
        $eloquentSlip->save();
    }

}
