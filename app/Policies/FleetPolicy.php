<?php

namespace App\Policies;

use App\Models\Fleet;
use App\Models\User;

class FleetPolicy
{
    /**
     * @param User|null $user
     * @param Fleet $fleet
     * @return bool
     */
    public function update(?User $user, Fleet $fleet): bool
    {
        // Only owner can update fleet
        if ($fleet->user_id !== null) {
            return $user !== null && $fleet->user_id === $user->id;
        }

        // If no user, assume guest user and check session
        return request()->hasSession()
            && in_array($fleet->id, session('guestFleetIds', []), true);
    }

    /**
     * @param User|null $user
     * @param Fleet $fleet
     * @return bool
     */
    public function delete(?User $user, Fleet $fleet): bool
    {
        return $this->update($user, $fleet);
    }
}
