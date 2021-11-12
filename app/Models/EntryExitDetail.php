<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntryExitDetail extends Model
{
    use HasFactory;

    public function slip()
    {
        return $this->hasOne("\App\Models\EntryExitSlip","entry_exit_id");
    }
}
