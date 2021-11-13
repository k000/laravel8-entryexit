<?php

namespace App\Domain\Service;

use Illuminate\Http\Request;

interface EntryExitService
{
    public function create(Request $request);

    public function getAll();

    public function getByEntryExitId(int $id);

    public function update(Request $request);

    public function delete(int $id);
}
