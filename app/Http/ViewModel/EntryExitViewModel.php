<?php

namespace App\Http\ViewModel;

use Carbon\Carbon;

class EntryExitViewModel
{
    // ロジックに直接関わることがないのでpublicにしています
    // Viewに関わるものを保持する
    public Carbon $slipDate;

    public string $updateUser;

    public int $entryexitId;

    public string $slipDiv;

    public array $details = array();

    // View側を修正後、メソッドは削除する
    public function getUpdateUser()
    {
        return $this->updateUser;
    }

    public function getSlipDate()
    {
        return $this->slipDate;
    }

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