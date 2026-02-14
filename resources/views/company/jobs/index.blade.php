@extends('layouts.app')

@section('content')

<x-page.header
    title="Jobs"
    subtitle="Manage your job postings"
    buttonText="+ Create Job"
    :buttonLink="route('company.jobs.create')" />

<x-table.card
    title="Your Job Posts"
    subtitle="All positions created in your workspace">

    @if($jobs->count())

    {{-- Table Header --}}
    <thead class="bg-slate-50 text-slate-600">
        <tr>
            <th class="px-4 py-3 text-left">Title</th>
            <th class="px-4 py-3 text-left">Status</th>
            <th class="px-4 py-3 text-left">Type</th>
            <th class="px-4 py-3 text-left">Location</th>
            <th class="px-4 py-3 text-right">Actions</th>
        </tr>
    </thead>

    {{-- Table Body --}}
    <tbody class="divide-y divide-slate-200">

        @foreach($jobs as $job)
        <tr class="hover:bg-slate-50">

            <td class="px-4 py-3 font-semibold">
                {{ $job->title }}
            </td>

            <td class="px-4 py-3">
                <span class="px-2 py-1 text-xs rounded-full
                            {{ $job->status === 'open' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $job->status === 'draft' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $job->status === 'closed' ? 'bg-red-100 text-red-700' : '' }}">
                    {{ ucfirst($job->status) }}
                </span>
            </td>

            <td class="px-4 py-3">
                {{ ucfirst(str_replace('-', ' ', $job->type)) }}
            </td>

            <td class="px-4 py-3">
                {{ $job->location ?? '-' }}
            </td>


            <td class="px-4 py-3 text-right space-x-2">
                <a href="{{ route('company.jobs.show', $job) }}"
                    class="text-sky-600 hover:underline">
                    View
                </a>

                <a href="{{ route('company.jobs.edit', $job) }}"
                    class="text-sky-600 hover:underline">
                    Edit
                </a>

                <form method="POST"
                    action="{{ route('company.jobs.destroy', $job) }}"
                    class="inline">
                    @csrf
                    @method('DELETE')

                    <button class="text-red-600 hover:underline">
                        Delete
                    </button>
                </form>
            </td>

        </tr>
        @endforeach

    </tbody>

    @else

    <tbody>
        <tr>
            <td colspan="5" class="px-4 py-12 text-center text-slate-500">
                No jobs posted yet. Create your first job to start hiring.
            </td>
        </tr>
    </tbody>

    @endif

</x-table.card>

@endsection