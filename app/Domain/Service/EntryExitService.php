<?php

namespace App\Domain\Service;

use Illuminate\Http\Request;

interface EntryExitService
{
    public function create(Request $request);
}
