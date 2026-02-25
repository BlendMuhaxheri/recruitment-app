@extends('layouts.app')

@section('content')

<x-page.header
    title="Schedule Interview"
    subtitle="Create a new interview for this candidate"
    buttonText="← Back to Candidate"
    :buttonLink="route('company.candidates.show', $application->candidate_id)" />

<div class="max-w-2xl mx-auto">
    <x-table.card
        title="Interview Details"
        subtitle="Fill in the information below">

        <form method="POST"
            action="{{ route('company.applications.interviews.store', $application) }}"
            class="p-10">
            @csrf

            <div class="space-y-10">
                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6">
                    <div class="grid grid-cols-2 gap-8">

                        <div>
                            <p class="text-xs uppercase tracking-wide text-slate-400 mb-1">
                                Candidate
                            </p>
                            <p class="text-lg font-semibold text-slate-800">
                                {{ $application->candidate->first_name }}
                                {{ $application->candidate->last_name }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs uppercase tracking-wide text-slate-400 mb-1">
                                Job Position
                            </p>
                            <p class="text-lg font-semibold text-slate-800">
                                {{ $application->job->title }}
                            </p>
                        </div>

                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <x-form.input
                            type="datetime-local"
                            name="scheduled_at"
                            label="Date & Time"
                            :value="old('scheduled_at')"
                            required />
                    </div>
                    <div>
                        <x-form.select
                            name="type"
                            label="Interview Type"
                            :value="old('type')"
                            :options="[
                        'zoom' => 'Zoom',
                        'on_site' => 'On-site',
                        'phone' => 'Phone'
                    ]"
                            required />
                    </div>
                    <div class="md:col-span-2">
                        <x-form.input
                            type="text"
                            name="location"
                            label="Location / Meeting Link"
                            placeholder="Enter office address or Zoom link"
                            :value="old('location')" />
                    </div>
                </div>
                <div class="flex justify-end border-t border-slate-200 pt-6">
                    <button type="submit"
                        class="px-8 py-3 bg-sky-600 text-white rounded-xl text-sm font-semibold hover:bg-sky-700 transition shadow-sm">
                        Schedule Interview
                    </button>
                </div>
            </div>
        </form>
    </x-table.card>
</div>
@endsection