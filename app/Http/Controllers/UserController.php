<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login()
    {
        return view('login');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('home');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register() {

        return redirect()->back();
    }
}
