<?php

namespace App\Http\Controllers;

use App\Domain\Service\StockService;
use Illuminate\Http\Request;

class StockController extends Controller
{

    private StockService $appService;

    public function __construct(StockService $service)
    {
        $this->appService = $service;
    }

    public function all()
    {
        // 在庫状況
        $stocks = $this->appService->getAll();

        return view('stock.all', compact('stocks'));
    }

}
