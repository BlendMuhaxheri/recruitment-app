@extends('layouts.app')

@section('content')

<x-page.header
    title="Job Details"
    subtitle="View and manage this job posting"
    buttonText="← Back to Jobs"
    :buttonLink="route('company.jobs.index')" />

<x-table.card
    title="{{ $job->title }}"
    subtitle="Job information inside your workspace">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">

        <div>
            <p class="text-sm text-slate-500">Status</p>

            <span class="inline-block mt-1 px-3 py-1 text-xs font-semibold rounded-full
                {{ $job->status === 'open' ? 'bg-green-100 text-green-700' : '' }}
                {{ $job->status === 'draft' ? 'bg-yellow-100 text-yellow-700' : '' }}
                {{ $job->status === 'closed' ? 'bg-red-100 text-red-700' : '' }}">
                {{ ucfirst($job->status) }}
            </span>
        </div>

        <div>
            <p class="text-sm text-slate-500">Job Type</p>
            <p class="font-semibold text-slate-800 mt-1">
                {{ ucfirst(str_replace('-', ' ', $job->type)) }}
            </p>
        </div>

        <div>
            <p class="text-sm text-slate-500">Department</p>
            <p class="font-semibold text-slate-800 mt-1">
                {{ $job->department ?? '—' }}
            </p>
        </div>

        <div>
            <p class="text-sm text-slate-500">Location</p>
            <p class="font-semibold text-slate-800 mt-1">
                {{ $job->location ?? '—' }}
            </p>
        </div>

        <div>
            <p class="text-sm text-slate-500">Created At</p>
            <p class="font-semibold text-slate-800 mt-1">
                {{ $job->created_at->format('M d, Y') }}
            </p>
        </div>

        <div>
            <p class="text-sm text-slate-500">Published</p>
            <p class="font-semibold text-slate-800 mt-1">
                {{ $job->published_at ? $job->published_at->format('M d, Y') : 'Not published yet' }}
            </p>
        </div>

    </div>

    <div class="flex justify-end gap-3 border-t border-slate-200 px-6 py-4">

        <a href="{{ route('company.jobs.edit', $job) }}"
            class="px-4 py-2 rounded-lg bg-sky-600 text-white text-sm hover:bg-sky-700">
            Edit Job
        </a>

        <form method="POST"
            action="{{ route('company.jobs.destroy', $job) }}">
            @csrf
            @method('DELETE')


            <x-form.button type="submit" variant="danger">
                Archive Job
            </x-form.button>
        </form>

    </div>

</x-table.card>

@endsection