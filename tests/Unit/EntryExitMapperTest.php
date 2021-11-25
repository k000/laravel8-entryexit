<?php

namespace Tests\Unit;

use App\Domain\Model\Entity\EntryExitDetail;
use App\Domain\Model\Entity\EntryExitSlip;
use App\Http\Mapper\EntryExitMapper;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class EntryExitMapperTest extends TestCase
{

    public function test_複数伝票のマッピングができる()
    {
        $logic = new EntryExitMapper();
        $models = $logic->toViewModels($this->makeSlips());
        // TODO 検証

    }

    public function test_複数伝票かつ複数明細のマッピングができる()
    {
        $logic = new EntryExitMapper();
        $slips = $this->makeSlips();

        // これでも型保証できる
        array_walk($slips, function(EntryExitSlip $slip){
            if($slip->getEntryExitId() == 1)
            {
                $slip->safeAddDetail($this->makeDetail(1));
                $slip->safeAddDetail($this->makeDetail(1));
                $slip->safeAddDetail($this->makeDetail(1));
            }
            if($slip->getEntryExitId() == 2)
            {
                $slip->safeAddDetail($this->makeDetail(2));
            }
        });

        $models = $logic->toViewModels($slips);

        // TODO 検証
        // dd($models);

    }


    public function test_単数伝票のマッピングができる()
    {
        $logic = new EntryExitMapper();
        $slip = $this->makeSlip(1);
        $model = $logic->toViewModel($slip);

        // TODO 検証
        //dd($model);
    }

    public function test_単数伝票かつ複数明細のマッピングができる()
    {
        $logic = new EntryExitMapper();
        $slip = $this->makeSlip(1);
        $addDetail = $this->makeDetail(1);
        $slip->safeAddDetail($addDetail);
        $model = $logic->toViewModel($slip);

        // TODO 検証
        // dd($model);
    }


    
    /**
     * 伝票を３件取得します。
     */
    private function makeSlips()
    {
        $result = array();


        $slipa = $this->makeSlip(1);
        $slipb = $this->makeSlip(2);
        $slipc = $this->makeSlip(3);

        array_push($result,$slipa);
        array_push($result,$slipb);
        array_push($result,$slipc);

        return $result;
        
    }

    /**
     * 明細が1件入った伝票を取得します。
     */
    private function makeSlip($id): EntryExitSlip
    {
        $slip = new EntryExitSlip();

        $slip->setEntryExitId($id);
        $slip->setSlipDiv("出庫");
        $slip->setUpdateUser("テストユーザー");
        $slip->setSlipDate(new Carbon('2021-11-25'));
        
        $detail = $this->makeDetail($id);

        $slip->safeAddDetail($detail);
     
        return $slip;
    }

    private function makeDetail($id): EntryExitDetail
    {
        $detail = new EntryExitDetail();

        $detail->setEntryExitNo($id);
        $detail->setDetailDiv("入庫");
        $detail->setCount(100);
        $detail->setItemName("テスト商品");
        $detail->setwarehouseName("テスト倉庫");
        $detail->setUnit("テスト単位");

        return $detail;
    }

 


}

