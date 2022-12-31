<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use TCG\Voyager\Policies\UserPolicy;

class ViewWebSocketPolicy extends UserPolicy
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

    public function viewWebSocketsDashboard(User $user): bool
    {
        return $user->hasPermission('browse_admin');
    }
}
