<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\SocialiteService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    private $socialiteService;

    public function __construct(SocialiteService $socialiteService)
    {
        $this->socialiteService = $socialiteService;
    }

    /**
     * @param string $driver
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirect(string $driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    /**
     * @param string $driver
     * @return RedirectResponse
     */
    public function callback(string $driver)
    {
        return $this->handleSocialiteCallback($driver);
    }

    /**
     * @param string $driver
     * @return RedirectResponse
     */
    private function handleSocialiteCallback(string $driver) : RedirectResponse
    {
        try {
            $this->socialiteService->handleSocialiteUser($driver);

            return redirect()->route('home');
        } catch (\Exception $e) {
            Log::error(ucfirst($driver) . ' login failed: ' . $e->getMessage());
            return redirect()->route('show-login')->withErrors([
                'social' => 'Login with ' . ucfirst($driver) . ' failed. Please try again.',
            ]);
        }
    }
}
