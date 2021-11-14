<?php

namespace Tests\Unit;

use App\Domain\Logic\Rule\EntryExit\VaildCountRule;
use App\Domain\Model\Entity\EntryExitDetail;
use App\Domain\Model\Entity\EntryExitSlip;
use PHPUnit\Framework\TestCase;

class VaildCountRuleTest extends TestCase
{
    public function test_入庫でマイナス件数はエラー()
    {
        $slip = $this->getSlip();
        $detail = $this->getDetail("入庫",-100);
        $slip->safeAddDetail($detail);

        $rule = new VaildCountRule($slip);
        $result = $rule->vaild();

        $this->assertCount(1, $result);

    }

    public function test_入庫でプラス件数はエラーにならない()
    {
        $slip = $this->getSlip();
        $detail = $this->getDetail("入庫",100);
        $slip->safeAddDetail($detail);

        $rule = new VaildCountRule($slip);
        $result = $rule->vaild();

        $this->assertEmpty($result);
    }

    public function test_入庫でマイナス件数が一件でもあればエラー()
    {
        $slip = $this->getSlip();
        $detail = $this->getDetail("入庫",-100);
        $detail2 = $this->getDetail("入庫",100);
        $slip->safeAddDetail($detail);
        $slip->safeAddDetail($detail2);

        $rule = new VaildCountRule($slip);
        $result = $rule->vaild();

        $this->assertCount(1, $result);
    }

    public function test_出庫でプラス件数はエラー()
    {
        $slip = $this->getSlip();
        $detail = $this->getDetail("出庫",100);
        $slip->safeAddDetail($detail);

        $rule = new VaildCountRule($slip);
        $result = $rule->vaild();

        $this->assertCount(1, $result);
    }

    public function test_出庫でマイナス件数はエラーにならない()
    {
        $slip = $this->getSlip();
        $detail = $this->getDetail("出庫",-100);
        $slip->safeAddDetail($detail);

        $rule = new VaildCountRule($slip);
        $result = $rule->vaild();

        $this->assertEmpty($result);
    }

    public function test_出庫でプラス件数が一件でもあればエラー()
    {
        $slip = $this->getSlip();
        $detail = $this->getDetail("出庫",-100);
        $detail2 = $this->getDetail("出庫",100);
        $slip->safeAddDetail($detail);
        $slip->safeAddDetail($detail2);

        $rule = new VaildCountRule($slip);
        $result = $rule->vaild();

        $this->assertCount(1, $result);
    }

    public function test_返品でマイナス件数はエラー()
    {
        $slip = $this->getSlip();
        $detail = $this->getDetail("返品",-100);
        $slip->safeAddDetail($detail);

        $rule = new VaildCountRule($slip);
        $result = $rule->vaild();

        $this->assertCount(1, $result);
    }

    public function test_返品でプラス件数はエラーにならない()
    {
        $slip = $this->getSlip();
        $detail = $this->getDetail("返品",100);
        $slip->safeAddDetail($detail);

        $rule = new VaildCountRule($slip);
        $result = $rule->vaild();

        $this->assertEmpty($result);
    }

    public function test_破棄でプラス件数はエラー()
    {
        $slip = $this->getSlip();
        $detail = $this->getDetail("破棄",100);
        $slip->safeAddDetail($detail);

        $rule = new VaildCountRule($slip);
        $result = $rule->vaild();

        $this->assertCount(1, $result);
    }


    public function test_破棄でマイナス件数はエラーにならない()
    {
        $slip = $this->getSlip();
        $detail = $this->getDetail("破棄",-100);
        $slip->safeAddDetail($detail);

        $rule = new VaildCountRule($slip);
        $result = $rule->vaild();

        $this->assertEmpty($result);
    }

    private function getSlip()
    {
        return  new EntryExitSlip();
    }

    private function getDetail($div,$count)
    {
        $detail = new EntryExitDetail();
        $detail->setDetailDiv($div);
        $detail->setCount($count);
        return $detail;
    }

}
