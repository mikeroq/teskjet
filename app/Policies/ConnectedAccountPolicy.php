<?php

/** @noinspection PhpPureAttributeCanBeAddedInspection */

namespace App\Policies;

use App\Models\ConnectedAccount;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConnectedAccountPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, ConnectedAccount $connectedAccount): bool
    {
        return $user->ownsConnectedAccount($connectedAccount);
    }

    public function create(User $user): mixed
    {
        return true;
    }

    public function update(User $user, ConnectedAccount $connectedAccount): mixed
    {
        return $user->ownsConnectedAccount($connectedAccount);
    }

    public function delete(User $user, ConnectedAccount $connectedAccount): bool
    {
        return $user->ownsConnectedAccount($connectedAccount);
    }
}
