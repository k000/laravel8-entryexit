<?php

namespace App\Policies;

use App\Domain\Model\Entity\EntryExitSlip;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Authenticatable;

class EntryExitSlipPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // EntryExitSlipはModelsでなくてEntity
    public function update(Authenticatable $authenticatable, EntryExitSlip $slip): bool
    {
        return intval($authenticatable->getAuthIdentifier()) === intval($slip->getUpdateUser());
    }

}
