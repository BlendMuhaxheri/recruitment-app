@extends('layouts.guest')

@section('title', $company->name . ' Careers')

@section('content')

<div class="max-w-6xl mx-auto px-4 py-16">
    <x-page.header
        title="Join {{ $company->name }}"
        subtitle=" Explore open positions and become part of our team." />

    <div class="grid gap-6 md:grid-cols-2">

        @forelse($jobs as $job)

        <x-card.card>

            <h2 class="text-xl font-semibold text-slate-900">
                {{ $job->title }}
            </h2>

            <p class="mt-2 text-sm text-slate-500">
                {{ $job->department ?? 'General' }} • {{ $job->location ?? 'Remote' }}
            </p>

            <div class="mt-6 flex justify-between items-center">

                <a href="{{ route('public.jobs.show', [$company->slug, $job->slug]) }}"
                    class="text-sky-600 font-medium hover:underline">
                    View Details →
                </a>

                <span class="text-xs text-slate-400">
                    Posted {{ $job->created_at->diffForHumans() }}
                </span>

            </div>

        </x-card.card>

        @empty
        <p>No open positions.</p>
        @endforelse


    </div>

</div>

@endsection