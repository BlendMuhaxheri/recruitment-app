@extends('layouts.guest')

@section('title', 'Apply — ' . $job->title)

@section('content')
<div class="max-w-3xl mx-auto px-6 py-12">
    <x-page.header
        title="Apply for {{ $job->title }}"
        subtitle="Submit your application to {{ $company->name }}"
        buttonText="← Back to Job"
        :buttonLink="route('public.jobs.show', [$company->slug, $job->slug])" />

    <x-form.card>

        <form method="POST"
            action="{{ route('public.jobs.apply.store', [$company->slug, $job->slug]) }}"
            enctype="multipart/form-data"
            class="space-y-6">

            @csrf

            <x-form.input
                name="first_name"
                label="First Name"
                placeholder="John"
                required />

            <x-form.input
                name="last_name"
                label="Last Name"
                placeholder="Doe"
                required />

            <x-form.input
                name="email"
                label="Email Address"
                placeholder="john@example.com"
                required />

            <x-form.input
                name="phone"
                label="Phone Number (optional)"
                placeholder="+49 123 456 789" />

            <x-form.input
                name="resume"
                label="Resume (PDF optional)"
                type="file" />

            <x-form.textarea
                name="cover_letter"
                label="Cover Letter (optional)"
                placeholder="Tell us why you're a great fit..."
                rows="6" />

            <div class="flex justify-end pt-4">
                <x-form.button type="submit">
                    Submit Application
                </x-form.button>
            </div>

        </form>

    </x-form.card>

</div>
@endsection