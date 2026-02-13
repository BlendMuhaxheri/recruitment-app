@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md">

        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold">Create Workspace</h1>
            <p class="text-slate-600 mt-2">
                Recruiter signup — company gets created automatically
            </p>
        </div>

        <x-form.card>
            <form method="POST" action="/register" class="space-y-5">
                @csrf

                <x-form.input
                    name="company_name"
                    label="Company Name"
                    placeholder="Acme Inc." />

                <x-form.input
                    name="name"
                    label="Your Name"
                    placeholder="John Recruiter" />

                <x-form.input
                    name="email"
                    type="email"
                    label="Work Email"
                    placeholder="you@acme.com" />

                <x-form.input
                    name="password"
                    type="password"
                    label="Password"
                    placeholder="••••••••" />

                <x-form.input
                    name="password_confirmation"
                    type="password"
                    label="Confirm Password"
                    placeholder="••••••••" />

                <x-form.button>
                    Create Account
                </x-form.button>

                <p class="text-center text-sm text-slate-600">
                    Already have an account?
                    <a href="{{route('login')}}" class="font-semibold text-slate-900 hover:underline">
                        Sign in
                    </a>
                </p>
            </form>
        </x-form.card>

    </div>
</div>
@endsection