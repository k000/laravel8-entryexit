<?php

namespace App\Http\Controllers;

use App\Domain\Service\ItemService;
use App\Http\Requests\StoreItemRequest;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    private ItemService $service;

    public function __construct(ItemService $service)
    {
        $this->service = $service;
    }

    public function store(StoreItemRequest $request)
    {
        $this->service->create($request);
    }
}
