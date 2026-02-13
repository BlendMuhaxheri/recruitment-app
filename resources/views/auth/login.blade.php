@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md">

        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold">Welcome back</h1>
            <p class="text-slate-600 mt-2">
                Login to your company dashboard
            </p>
        </div>

        <x-form.card>
            <form method="POST" action="/login" class="space-y-5">
                @csrf

                <x-form.input
                    name="email"
                    type="email"
                    label="Email"
                    placeholder="you@company.com" />

                <x-form.input
                    name="password"
                    type="password"
                    label="Password"
                    placeholder="••••••••" />

                {{-- Remember + Forgot --}}
                <div class="flex items-center justify-between text-sm">

                    <label class="flex items-center gap-2 text-slate-600">
                        <input
                            type="checkbox"
                            name="remember"
                            value="1"
                            class="rounded border-slate-300">
                        Remember me
                    </label>

                    <a href="#" class="font-medium text-slate-800 hover:underline">
                        Forgot password?
                    </a>
                </div>

                <x-form.button type="submit">
                    Sign in
                </x-form.button>

                <p class="text-center text-sm text-slate-600">
                    Don’t have an account?
                    <a href="{{route('register')}}" class="font-semibold text-slate-900 hover:underline">
                        Create one
                    </a>
                </p>

            </form>
        </x-form.card>

    </div>
</div>
@endsection