@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-10">

    <x-page.header
        title="Edit Job"
        subtitle="Update this job posting inside your workspace"
        :buttonText="'Back to Jobs'"
        :buttonLink="url('/company/jobs')" />

    <x-form.card>
        <form method="POST" action="{{ route('company.jobs.update', $job->id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <x-form.input
                name="title"
                label="Job Title"
                placeholder="Backend Engineer"
                :value="old('title', $job->title)" />

            <x-form.input
                name="location"
                label="Location"
                placeholder="Berlin / Remote"
                :value="old('location', $job->location)" />

            <x-form.input
                name="departament"
                label="Department"
                placeholder="Engineering"
                :value="old('departament', $job->departament)" />

            <x-form.select
                name="status"
                label="Job Status"
                :options="$statuses"
                :value="$job->status" />

            <x-form.select
                name="type"
                label="Job Type"
                :options="$types"
                :value="$job->type" />

            <div class="flex justify-end gap-3 pt-4">

                <a href="{{ url('/company/jobs') }}"
                    class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100">
                    Cancel
                </a>

                <x-form.button type="submit">
                    Update Job
                </x-form.button>

            </div>

        </form>
    </x-form.card>

</div>
@endsection