@extends('layouts.app')

@section('title', 'Company Dashboard')

@section('pageTitle', 'Dashboard')
@section('pageSubtitle', 'Overview of your hiring activity')

@section('content')

{{-- Stats Section --}}
<section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

    <x-card.stat-card title="Total Jobs" value="12" extra="+2 this month" />
    <x-card.stat-card title="Active Jobs" value="7" extra="4 closing soon" />
    <x-card.stat-card title="Applications" value="128" extra="+18 this week" />
    <x-card.stat-card title="Interviews" value="9" extra="3 today" />

</section>

{{-- Recent Applications Table --}}
<div class="mt-8">

    <x-table.card
        title="Recent Applications"
        subtitle="Latest candidates in your pipeline">

        {{-- Table Header --}}
        <thead class="bg-slate-50 text-slate-600">
            <tr>
                <th class="px-4 py-3 text-left">Candidate</th>
                <th class="px-4 py-3 text-left">Job</th>
                <th class="px-4 py-3 text-left">Stage</th>
                <th class="px-4 py-3 text-left">Applied</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>

        {{-- Table Body --}}
        <tbody class="divide-y divide-slate-200">

            <tr>
                <td class="px-4 py-3">
                    <div class="font-semibold">Sarah Johnson</div>
                    <div class="text-xs text-slate-500">
                        sarah@email.com
                    </div>
                </td>

                <td class="px-4 py-3">
                    Backend Engineer
                </td>

                <td class="px-4 py-3">
                    <span class="px-2 py-1 text-xs rounded-full bg-sky-100 text-sky-700">
                        Screening
                    </span>
                </td>

                <td class="px-4 py-3 text-slate-500">
                    2 hours ago
                </td>

                <td class="px-4 py-3 text-right">
                    <x-form.button>
                        Review
                    </x-form.button>
                </td>
            </tr>

        </tbody>

    </x-table.card>

</div>

@endsection