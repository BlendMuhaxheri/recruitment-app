@extends('layouts.app')

@section('title', 'Company Dashboard')

@section('pageTitle', 'Dashboard')
@section('pageSubtitle', 'Overview of your hiring activity')

@section('content')

<section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

    <x-card.stat-card title="Total Jobs" value="12" extra="+2 this month" />
    <x-card.stat-card title="Active Jobs" value="7" extra="4 closing soon" />
    <x-card.stat-card title="Applications" value="128" extra="+18 this week" />
    <x-card.stat-card title="Interviews" value="9" extra="3 today" />

</section>

<div class="mt-8">
    <x-table.card
        title="Recent Applications"
        subtitle="Latest candidates in your pipeline">

        <thead class="bg-slate-50 text-slate-600">
            <tr>
                <th class="px-4 py-3 text-left">Candidate</th>
                <th class="px-4 py-3 text-left">Job</th>
                <th class="px-4 py-3 text-left">Stage</th>
                <th class="px-4 py-3 text-left">Applied</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>

        <tbody class="divide-y divide-slate-200">

            @forelse($applications as $application)

            <tr>
                <td class="px-4 py-3">
                    <div class="font-semibold">
                        {{ $application->candidate->name }}
                    </div>

                    <div class="text-xs text-slate-500">
                        {{ $application->candidate->email }}
                    </div>
                </td>

                <td class="px-4 py-3">
                    {{ $application->job->title }}
                </td>

                <td class="px-4 py-3">
                    @php
                    $stageColors = [
                    'applied' => 'bg-gray-100 text-gray-700',
                    'screening' => 'bg-sky-100 text-sky-700',
                    'interview' => 'bg-purple-100 text-purple-700',
                    'accepted' => 'bg-green-100 text-green-700',
                    'rejected' => 'bg-red-100 text-red-700',
                    ];
                    @endphp

                    <span class="px-2 py-1 text-xs rounded-full {{ $stageColors[$application->application_stage] ?? 'bg-gray-100 text-gray-700' }}">
                        {{ ucfirst($application->application_stage) }}
                    </span>
                </td>

                <td class="px-4 py-3 text-slate-500">
                    {{ $application->created_at->diffForHumans() }}
                </td>

                <td class="px-4 py-3 text-right">
                    <a>
                        <x-form.button>
                            Review
                        </x-form.button>
                    </a>
                </td>

            </tr>

            @empty
            <tr>
                <td colspan="5" class="px-4 py-6 text-center text-slate-500">
                    No recent applications yet.
                </td>
            </tr>
            @endforelse

        </tbody>


    </x-table.card>

</div>

@endsection