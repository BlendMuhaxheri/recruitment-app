@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-10">

    <x-page.header
        title="Create Job"
        subtitle="Post a new position inside your company workspace"
        :buttonText="'Back to Jobs'"
        :buttonLink="url('/company/jobs')" />

    <x-form.card>
        <form method="POST" action="{{ route('company.jobs.store') }}" class="space-y-6">
            @csrf
            <x-form.input
                name="title"
                label="Job Title"
                placeholder="Backend Engineer" />

            <x-form.input
                name="location"
                label="Location"
                placeholder="Berlin / Remote" />

            <x-form.input
                name="departament"
                label="Department"
                placeholder="Engineering" />

            <x-form.select
                name="status"
                label="Job Status"
                :options="$statuses" />

            <x-form.select
                name="type"
                label="Job Type"
                :options="$types" />

            <div class="flex justify-end pt-4">
                <x-form.button type="submit">
                    Create Job
                </x-form.button>
            </div>

        </form>
    </x-form.card>

</div>
@endsection