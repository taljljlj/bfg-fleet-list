<?php

namespace App\Services\Auth;

use App\Models\Fleet;

class UserService
{
    /**
     * Transfer guest fleets to the current user and clear session key
     * @return void
     */
    public function transferGuestFleets () : void
    {
        $guestFleetIds = session('guestFleetIds', []);
        foreach ($guestFleetIds as $fleetId) {
            Fleet::whereKey($fleetId)->update(['user_id' => auth()->id()]);
        }
        session()->forget('guestFleetIds');
    }
}
