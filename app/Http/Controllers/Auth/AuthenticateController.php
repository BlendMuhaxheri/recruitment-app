<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthenticateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticateController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function authenticate(AuthenticateUserRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => 'The provided credentials are wrong!'
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('company.dashboard');
    }
}
