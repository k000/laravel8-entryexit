<?php

namespace App\Domain\Service\Impl;

use App\Domain\Model\Entity\Item;
use App\Domain\Repository\ItemRepository;
use App\Domain\Service\ItemService;
use App\Http\Requests\StoreItemRequest;

class ItemServiceImpl implements ItemService
{

    private ItemRepository $repository;

    public function __construct(ItemRepository $repository)
    {
        $this->repository = $repository;
    }

    // やることは少ないです

    public function create(StoreItemRequest $request)
    {
        // 商品マスタに商品を登録します。

        //　ドメインモデルを作成して、リポジトリの実装クラス（infrastructure）に引き渡します。
        $item = new Item($request->name, $request->price);

        $this->repository->create($item);

    }

}
