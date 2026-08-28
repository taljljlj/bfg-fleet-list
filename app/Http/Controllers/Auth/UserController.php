<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Auth\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{
    protected $logger;
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->logger = Log::channel('user');
        $this->middleware('guest')->except('logout');
        $this->userService = $userService;
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        try {
            if (auth()->attempt(['email' => $validated['email'], 'password' => $validated['password']], $request->get('remember'))) {
                $this->userService->transferGuestFleets();
                $request->session()->regenerate();

                return redirect()->route('home');
            }
            $this->logger->warning('Login failed for email: '.$validated['email']);
        } catch (\Exception $e) {
            $this->logger->error('Login exception: '.$e->getMessage());
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->back();
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            auth()->login($user);
        } catch (\Exception $e) {
            $this->logger->error('Registration exception: '.$e->getMessage());
        }

        return redirect()->route('home');
    }

    public function showPasswordResetLinkRequestForm()
    {
        return view('auth.request-email-link');
    }

    public function sendPasswordResetLinkEmail (Request $request) {
        $validated = $request->validate([
            'email' => 'required|string|email',
        ]);

        $status = Password::sendResetLink(
            $validated
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function showPasswordResetForm ($token) {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword (Request $request) {
        $validated = $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $status = Password::reset(
            $validated,
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('show-login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
