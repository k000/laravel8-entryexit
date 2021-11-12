<?php

namespace App\Http\Controllers;

use App\Domain\Service\EntryExitComboboxService;
use App\Domain\Service\EntryExitService;
use Illuminate\Http\Request;

class EntryExitController extends Controller
{

    private EntryExitComboboxService $comboboxService;

    private EntryExitService $appService;

    public function __construct(EntryExitComboboxService $service, EntryExitService $appService)
    {
        $this->comboboxService = $service;
        $this->appService = $appService;

    }

    public function create()
    {
        $comboboxs = $entryexitCombo = $this->comboboxService->getEntryExitCombobox();

        return view('slip.create', compact('comboboxs'));
    }


    public function store(Request $request)
    {
        $this->appService->create($request);
    }


    public function all()
    {
        // 伝票情報
        $slips = $this->appService->getAll();

        return view('slip.all', compact('slips'));
    }

}
