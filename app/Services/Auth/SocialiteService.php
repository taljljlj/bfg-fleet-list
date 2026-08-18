<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class SocialiteService
{
    /**
     * @param string $driver
     * @return void
     */
    public function handleSocialiteUser(string $driver) : void
    {
        $socialiteUser = Socialite::driver($driver)->user();

        // Find or create user
        $user = User::updateOrCreate(
            ['email' => $socialiteUser->getEmail()],
            [
                'name' => $socialiteUser->getName(),
                'provider' => $driver,
                'provider_id' => $socialiteUser->getId(),
                // optional: set a random password if new
                'password' => bcrypt(str()->random(16)),
            ]
        );

        auth()->login($user);
    }
}
