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


    public function edit($id)
    {
        // 伝票情報を取得
        $slip = $this->appService->getByEntryExitId($id);
        // コンボボックスの取得
        $comboboxs = $entryexitCombo = $this->comboboxService->getEntryExitCombobox();
    
        // Viewの反映
        return view('slip.edit', compact('slip','comboboxs'));

    }

    public function update(Request $request)
    {
        $this->appService->update($request);
    }

    public function delete($id)
    {
       $this->appService->delete($id);
    }

}
