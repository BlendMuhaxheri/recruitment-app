@extends('layouts.app')

@section('content')

@php
use App\Enums\Application\ApplicationStage;
@endphp

<x-page.header
    title="Candidate Profile"
    subtitle="View candidate details and application progress"
    buttonText="← Back to Candidates"
    :buttonLink="route('company.candidates.index')" />

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <div class="lg:col-span-2 space-y-6">
        <x-table.card
            title="{{ $candidate->first_name }} {{ $candidate->last_name }}"
            subtitle="{{ $candidate->email }}">

            <div class="p-6 space-y-4">

                <div>
                    <p class="text-sm text-slate-500">Applied At</p>
                    <p class="font-semibold text-slate-800 mt-1">
                        {{ $candidate->created_at->format('M d, Y') }}
                    </p>
                </div>

                @if($candidate->resume)
                <div>
                    <a href="{{ asset('storage/' . $candidate->resume) }}"
                        target="_blank"
                        class="px-4 py-2 rounded-lg border border-slate-200 text-sm hover:bg-slate-50 inline-block">
                        📄 View Resume
                    </a>
                </div>
                @endif

            </div>
        </x-table.card>
        <x-table.card
            title="Applications"
            subtitle="Jobs this candidate applied to">

            <div class="divide-y divide-slate-200">

                @forelse($candidate->applications as $application)

                @php
                $stageStyles = [
                'applied' => 'bg-gray-100 text-gray-700 border-gray-300',
                'screening' => 'bg-sky-100 text-sky-700 border-sky-300',
                'interview' => 'bg-purple-100 text-purple-700 border-purple-300',
                'accepted' => 'bg-green-100 text-green-700 border-green-300',
                'rejected' => 'bg-red-100 text-red-700 border-red-300',
                ];
                @endphp

                <div class="p-6 space-y-4">
                    <div class="flex justify-between items-center">

                        <div>
                            <p class="font-semibold text-slate-800">
                                {{ $application->job->title }}
                            </p>

                            <p class="text-sm text-slate-500 mt-1">
                                Applied on {{ $application->created_at->format('M d, Y') }}
                            </p>
                        </div>

                        <div class="flex items-center gap-3">

                            <form method="POST"
                                action="{{ route('company.applications.updateStage', $application) }}">
                                @csrf
                                @method('PATCH')

                                <x-form.select
                                    name="application_stage"
                                    :value="$application->application_stage"
                                    :options="\App\Enums\Application\ApplicationStage::options()"
                                    class="w-[140px] text-xs py-1 px-2 rounded-full border {{ $stageStyles[$application->application_stage] ?? 'border-gray-300' }}"
                                    onchange="if(this.value) this.form.submit()" />
                            </form>

                            @if(
                            !in_array($application->application_stage, [
                            ApplicationStage::Hired->value,
                            ApplicationStage::Rejected->value,
                            ])
                            && $application->interviews_count == 0
                            )
                            <a href="{{ route('company.applications.interviews.create', $application) }}"
                                class="text-sm px-3 py-1.5 rounded-lg border border-slate-200 hover:bg-slate-50">
                                Schedule Interview
                            </a>
                            @endif
                        </div>
                    </div>

                    @if($application->interviews->count())
                    <div class="space-y-2">
                        @foreach($application->interviews as $interview)
                        <div class="text-sm bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 flex justify-between">

                            <div>

                                <p class="text-xs text-slate-500">
                                    {{ ucfirst(str_replace('_',' ', $interview->type)) }}
                                </p>
                            </div>

                            <div class="space-x-3">
                                <a
                                    href="{{ route('company.applications.interviews.edit', [$application, $interview]) }}"
                                    class="text-sky-600 hover:underline text-xs">
                                    Edit
                                </a>

                                <form method="POST"
                                    action="{{ route('company.applications.interviews.destroy', [$application, $interview]) }}"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')

                                    <button class="text-red-600 hover:underline text-xs">
                                        Cancel
                                    </button>
                                </form>
                            </div>

                        </div>
                        @endforeach
                    </div>
                    @endif

                </div>

                @empty
                <div class="p-6 text-sm text-slate-500">
                    No applications found.
                </div>
                @endforelse

            </div>
        </x-table.card>

    </div>

    <div>
        <x-table.card
            title="Activity"
            subtitle="Timeline of candidate actions">

            <div class="p-6 space-y-5">
                <div class="flex justify-end">
                    <a href="#"
                        class="px-4 py-2 rounded-lg bg-sky-600 text-white text-sm hover:bg-sky-700">
                        Send Email
                    </a>
                </div>

                <div class="border-l border-slate-200 pl-5 space-y-4">

                    <div class="relative">
                        <span class="absolute -left-[10px] top-1 w-3 h-3 rounded-full bg-sky-500"></span>

                        <p class="text-sm font-medium text-slate-700">
                            Candidate applied
                        </p>

                        <p class="text-xs text-slate-400 mt-1">
                            {{ $candidate->created_at->diffForHumans() }}
                        </p>
                    </div>

                </div>

            </div>
        </x-table.card>
    </div>

</div>

@endsection