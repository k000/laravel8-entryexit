<?php

namespace Tests\Unit;

use App\Domain\Logic\Rule\EntryExit\TransactionCombinationRule;
use App\Domain\Model\Entity\EntryExitDetail;
use App\Domain\Model\Entity\EntryExitSlip;
use PHPUnit\Framework\TestCase;

class TransactionCombinationRuleTest extends TestCase
{

    public function test_入庫伝票と出庫明細の組み合わせエラーになる()
    {
        $slip = $this->getSlip("入庫");
        $detail = $this->getDetail("出庫");
        $slip->safeAddDetail($detail);

        $rule = new TransactionCombinationRule($slip);
        $result = $rule->vaild();

        $this->assertCount(1, $result);
    }

    
    public function test_入庫伝票と破棄明細の組み合わせエラーになる()
    {
        $slip = $this->getSlip("入庫");
        $detail = $this->getDetail("破棄");
        $slip->safeAddDetail($detail);

        $rule = new TransactionCombinationRule($slip);
        $result = $rule->vaild();

        $this->assertCount(1, $result);
    }


    public function test_出庫伝票と入庫明細の組み合わせエラーになる()
    {
        $slip = $this->getSlip("出庫");
        $detail = $this->getDetail("入庫");
        $slip->safeAddDetail($detail);

        $rule = new TransactionCombinationRule($slip);
        $result = $rule->vaild();

        $this->assertCount(1, $result);
    }

    public function test_出庫伝票と返品明細の組み合わせエラーになる()
    {
        $slip = $this->getSlip("出庫");
        $detail = $this->getDetail("返品");
        $slip->safeAddDetail($detail);

        $rule = new TransactionCombinationRule($slip);
        $result = $rule->vaild();

        $this->assertCount(1, $result);
    }


    public function test_入庫伝票と入庫明細の組み合わせエラーにならない()
    {
        $slip = $this->getSlip("入庫");
        $detail = $this->getDetail("入庫");
        $slip->safeAddDetail($detail);

        $rule = new TransactionCombinationRule($slip);
        $result = $rule->vaild();

        $this->assertEmpty($result);
    }

    public function test_出庫伝票と出庫明細の組み合わせエラーにならない()
    {
        $slip = $this->getSlip("出庫");
        $detail = $this->getDetail("出庫");
        $slip->safeAddDetail($detail);

        $rule = new TransactionCombinationRule($slip);
        $result = $rule->vaild();

        $this->assertEmpty($result);
    }

    public function test_入庫伝票と出庫明細、破棄明細の複数明細でエラーになる()
    {
        $slip = $this->getSlip("入庫");
        $detail = $this->getDetail("出庫");
        $detail2 = $this->getDetail("破棄");
        $slip->safeAddDetail($detail);
        $slip->safeAddDetail($detail2);

        $rule = new TransactionCombinationRule($slip);
        $result = $rule->vaild();

        $this->assertCount(2, $result);
    }

    public function test_入庫伝票と入庫明細、破棄明細で一件でもエラー明細があればエラーになる()
    {
        $slip = $this->getSlip("入庫");
        $detail = $this->getDetail("入庫");
        $detail2 = $this->getDetail("破棄");
        $slip->safeAddDetail($detail);
        $slip->safeAddDetail($detail2);

        $rule = new TransactionCombinationRule($slip);
        $result = $rule->vaild();

        $this->assertCount(1, $result);
    }

    public function test_入庫伝票と入庫明細、返品明細の複数明細でエラーにならない()
    {
        $slip = $this->getSlip("入庫");
        $detail = $this->getDetail("入庫");
        $detail2 = $this->getDetail("返品");
        $slip->safeAddDetail($detail);
        $slip->safeAddDetail($detail2);

        $rule = new TransactionCombinationRule($slip);
        $result = $rule->vaild();

        $this->assertEmpty($result);
    }

    private function getSlip($div)
    {
        $slip = new EntryExitSlip();
        $slip->setSlipDiv($div);
        return $slip;
    }

    private function getDetail($div)
    {
        $detail = new EntryExitDetail();
        $detail->setDetailDiv($div);
        return $detail;
    }
    
}
