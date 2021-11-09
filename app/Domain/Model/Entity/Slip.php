<?php

namespace App\Domain\Model\Entity;

use Carbon\Carbon;

/**
 * 
 * 伝票共通の処理等
 * 今後、●●機能追加に伴い拡張する
 * 
 */
abstract class Slip{

    protected Carbon $slipDate;

    protected string $updateUser;

}