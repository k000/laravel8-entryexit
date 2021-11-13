<?php

namespace Tests\Unit;

use App\Domain\Logic\Rule\EntryExit\SlipDivRule;
use App\Domain\Model\Entity\EntryExitSlip;
use PHPUnit\Framework\TestCase;

class SlipDivRuleTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }



    public function test_入庫→出庫でエラーになる()
    {

        $slips = $this->getSlip("入庫","出庫");

        $rule = new SlipDivRule($slips[1],$slips[0]);

        $result = $rule->vaild();

        $this->assertCount(1, $result);
    }

    public function test_出庫→入庫でエラーになる()
    {

        $slips = $this->getSlip("出庫","入庫");

        $rule = new SlipDivRule($slips[1],$slips[0]);

        $result = $rule->vaild();

        $this->assertCount(1, $result);
    }


    public function test_入庫→入庫でエラーにならない()
    {

        $slips = $this->getSlip("入庫","入庫");

        $rule = new SlipDivRule($slips[1],$slips[0]);

        $result = $rule->vaild();

        $this->assertEmpty($result);
    }

    public function test_出庫→出庫でエラーにならない()
    {

        $slips = $this->getSlip("出庫","出庫");

        $rule = new SlipDivRule($slips[1],$slips[0]);

        $result = $rule->vaild();

        $this->assertEmpty($result);
    }


    public function getSlip(string $olddiv, string $newdiv)
    {
        $oldSlip = new EntryExitSlip();
        $newSlip = new EntryExitSlip();

        $oldSlip->setSlipDiv($olddiv);
        $newSlip->setSlipDiv($newdiv);

        return [$oldSlip,$newSlip];
    }



}
