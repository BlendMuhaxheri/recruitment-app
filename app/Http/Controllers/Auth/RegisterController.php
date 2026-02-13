<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(RegisterUserRequest $request)
    {
        $validated = $request->validated();

        $company = Company::create([
            'name' => $validated['company_name'],
            'slug' => Str::slug($request['company_name'])
        ]);

        $user = $company->users()->create([
            'name'       => $validated['name'],
            'email'      => $validated['email'],
            'password'   => $validated['password'],
            'company_id' => $company->id
        ]);


        Auth::login($user);

        return redirect()->route('login');
    }
}
