<?php

namespace App\Http\Controllers;

use App\Domain\Service\EntryExitComboboxService;
use App\Domain\Service\ItemService;
use App\Domain\Service\WarehouseService;
use Illuminate\Http\Request;

class EntryExitController extends Controller
{

    private EntryExitComboboxService $comboboxService;


    public function __construct(EntryExitComboboxService $service)
    {
        $this->comboboxService = $service;
    }

    public function create()
    {
        // 新規作成Viewを返します

        // Viewに渡すModelとして、商品一覧、倉庫一覧の情報を一緒に渡す必要があります。
        // 依存の方向に注意
        $comboboxs = $entryexitCombo = $this->comboboxService->getEntryExitCombobox();

        dd($comboboxs);

        // 商品一覧の取得


        // 倉庫一覧の取得


        return view('slip.create');

    }

}
