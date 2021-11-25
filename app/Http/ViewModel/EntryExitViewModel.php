<?php

namespace App\Http\ViewModel;

class EntryExitViewModel
{
    // ロジックに直接関わることがないのでpublicにしています
    public int $entryexitId;

    public string $slipDiv;

    public array $details = array();

    // View側を修正後、メソッドは削除する
    public function getEntryExitId()
    {
        return $this->entryexitId;
    }

    public function getSlipDiv()
    {
        return $this->slipDiv;
    }


    public function getDetails()
    {
        return $this->details;
    }

}