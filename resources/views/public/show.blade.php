@extends('layouts.guest')

@section('title', $job->title . ' | ' . $company->name)

@section('content')

<div class="max-w-4xl mx-auto px-4 py-16">
    <div class="mb-8">
        <a href="{{ route('public.jobs.index', $company->slug) }}"
            class="text-sm text-slate-500 hover:text-slate-700">
            ← Back to Careers
        </a>
    </div>

    <div class="mb-10">
        <h1 class="text-4xl font-bold text-slate-900">
            {{ $job->title }}
        </h1>

        <div class="mt-4 text-slate-600">
            {{ $job->department ?? 'General' }}
            • {{ $job->location ?? 'Remote' }}
            • {{ ucfirst(str_replace('-', ' ', $job->type)) }}
        </div>
    </div>
    <x-card.card>

        <div class="prose max-w-none text-slate-700">
            {!! nl2br(e($job->description)) !!}
        </div>

        <div class="mt-10 border-t border-slate-200 pt-6 flex justify-between items-center">

            <div class="text-sm text-slate-500">
                Posted {{ $job->created_at->diffForHumans() }}
            </div>

            <a href="{{ route('public.jobs.apply', [$company->slug, $job->slug]) }}"
                class="px-6 py-3 bg-sky-600 text-white rounded-lg font-medium hover:bg-sky-700 transition">
                Apply Now
            </a>

        </div>

    </x-card.card>

</div>

@endsection