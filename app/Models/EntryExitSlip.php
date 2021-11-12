<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntryExitSlip extends Model
{
    use HasFactory;

    public function details()
    {
        return $this->hasMany('\App\Models\EntryExitDetail',"entry_exit_id","entry_exit_id");
    }
}
