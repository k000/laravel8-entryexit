<?php

namespace App\Domain\Model\Entity;

class EntryExitSlip extends Slip{

    private int $entryexitId;

    private string $slipDiv;

    private array $details = array();


    public function setEntryExitId(int $id)
    {
        $this->entryexitId = $id;
    }

    public function getEntryExitId()
    {
        return $this->entryexitId;
    }

    public function setSlipDiv(string $div)
    {
        $this->slipDiv = $div;
    }

    public function getSlipDiv()
    {
        return $this->slipDiv;
    }

    public function setDetails(array $details)
    {
        $this->details = $details;
    }
    

    public function getDetails()
    {
        return $this->details;
    }


    public function safeAddDetail(Detail $detail)
    {
        array_push($this->details,$detail);
    }

}