<?php

namespace App\Policies;

use App\Models\TravelOrder;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TravelOrderPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TravelOrder $travelOrder): Response
    {
        return $user->id === $travelOrder->user_id
            ? Response::allow()
            : Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TravelOrder $travelOrder): Response
    {
        return $user->id === $travelOrder->user_id
            ? Response::denyAsNotFound()
            : Response::allow();
    }
}
