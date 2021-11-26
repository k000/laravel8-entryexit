<?php

namespace App\Http\Controllers;

use App\Domain\Service\EntryExitComboboxService;
use App\Domain\Service\EntryExitService;
use App\Http\Mapper\EntryExitMapper;
use App\Models\EntryExitSlip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $entities = $this->appService->getAll();
        
        // ViewModelに変換する
        $mapper = new EntryExitMapper();
        $slips = $mapper->toViewModels($entities);

        return view('slip.all', compact('slips'));
    }


    public function edit($id)
    {
        // 伝票情報を取得
        $entity = $this->appService->getByEntryExitId($id);
        // コンボボックスの取得
        $comboboxs = $entryexitCombo = $this->comboboxService->getEntryExitCombobox();

        // toViewModel
        $mapper = new EntryExitMapper();
        $slip = $mapper->toViewModel($entity);
    
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


    public function updateSlip()
    {
        $model = new EntryExitSlip();
        $user = auth()->user();
        if($user->can('update',$model)){
            // 処理
        }
    }

}
