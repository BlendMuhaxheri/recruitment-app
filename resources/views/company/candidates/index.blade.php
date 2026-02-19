@extends('layouts.app')

@section('content')

<x-page.header
    title="Candidates"
    subtitle="Track all applicants across your job posts" />

<x-table.card
    title="Applications Pipeline"
    subtitle="Each row represents one candidate applying to one job">

    @if($applications->count())

    <thead class="bg-slate-50 text-slate-600">
        <tr>
            <th class="px-4 py-3 text-left">Candidate</th>
            <th class="px-4 py-3 text-left">Email</th>
            <th class="px-4 py-3 text-left">Job</th>
            <th class="px-4 py-3 text-left">Stage</th>
            <th class="px-4 py-3 text-right">Actions</th>
        </tr>
    </thead>

    <tbody class="divide-y divide-slate-200">
        @foreach($applications as $application)
        <tr class="hover:bg-slate-50">

            <td class="px-4 py-3 font-semibold">
                {{ $application->candidate->first_name }} {{ $application->candidate->last_name }}
            </td>

            <td class="px-4 py-3">
                {{ $application->candidate->email }}
            </td>

            <td class="px-4 py-3">
                {{ $application->job->title ?? '-' }}
            </td>

            <td class="px-4 py-3">
                @php
                $stageStyles = [
                'applied' => 'bg-gray-100 text-gray-700 border-gray-300',
                'screening' => 'bg-sky-100 text-sky-700 border-sky-300',
                'interview' => 'bg-purple-100 text-purple-700 border-purple-300',
                'accepted' => 'bg-green-100 text-green-700 border-green-300',
                'rejected' => 'bg-red-100 text-red-700 border-red-300',
                ];
                @endphp

                <form method="POST" action="{{route('company.applications.updateStage', $application)}}">
                    @csrf
                    @method('PATCH')

                    <x-form.select
                        name="application_stage"
                        :value="$application->application_stage"
                        :options="\App\Enums\Application\ApplicationStage::options()"
                        class="w-[140px] text-xs py-1 px-2 rounded-full border {{ $stageStyles[$application->application_stage] ?? 'border-gray-300' }}"
                        onchange="if(this.value) this.form.submit()" />

                </form>

            </td>
            <td class="px-4 py-3 text-right space-x-2">

                <a
                    class="text-sky-600 hover:underline">
                    View Candidate
                </a>

                <form method="POST"
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
            <td colspan="6" class="px-4 py-12 text-center text-slate-500">
                No applications yet. Once candidates apply, they will appear here.
            </td>
        </tr>
    </tbody>
    @endif
</x-table.card>
@endsection