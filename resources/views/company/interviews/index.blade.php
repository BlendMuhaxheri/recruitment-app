@extends('layouts.app')

@section('content')

<x-page.header
    title="Interviews"
    subtitle="Manage and track all scheduled interviews">

    <a
        class="bg-sky-600 hover:bg-sky-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
        + Schedule Interview
    </a>

</x-page.header>


<x-table.card
    title="Upcoming Interviews"
    subtitle="List of all upcoming interviews at your company">

    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">

        <div class="flex gap-2">
            <a href="{{ request()->fullUrlWithQuery(['filter' => 'all']) }}"
                class="px-3 py-1.5 text-sm rounded-lg border
                {{ request('filter') == 'all' || !request('filter') ? 'bg-sky-50 border-sky-400 text-sky-600' : 'bg-white border-slate-200 text-slate-600' }}">
                All
            </a>

            <a href="{{ request()->fullUrlWithQuery(['filter' => 'today']) }}"
                class="px-3 py-1.5 text-sm rounded-lg border
                {{ request('filter') == 'today' ? 'bg-sky-50 border-sky-400 text-sky-600' : 'bg-white border-slate-200 text-slate-600' }}">
                Today
            </a>

            <a href="{{ request()->fullUrlWithQuery(['filter' => 'tomorrow']) }}"
                class="px-3 py-1.5 text-sm rounded-lg border
                {{ request('filter') == 'tomorrow' ? 'bg-sky-50 border-sky-400 text-sky-600' : 'bg-white border-slate-200 text-slate-600' }}">
                Tomorrow
            </a>

            <a href="{{ request()->fullUrlWithQuery(['filter' => 'week']) }}"
                class="px-3 py-1.5 text-sm rounded-lg border
                {{ request('filter') == 'week' ? 'bg-sky-50 border-sky-400 text-sky-600' : 'bg-white border-slate-200 text-slate-600' }}">
                This Week
            </a>
        </div>

        <form method="GET" class="flex items-center gap-2">
            <input type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search interviews..."
                class="border border-slate-300 rounded-lg px-3 py-2 text-sm w-64 focus:ring focus:ring-sky-100 focus:border-sky-400">

            <button class="text-slate-600">
                🔍
            </button>
        </form>

    </div>


    @if($interviews->count())

    <thead class="bg-slate-50 text-slate-600">
        <tr>
            <th class="px-4 py-3 text-left">Candidate</th>
            <th class="px-4 py-3 text-left">Email</th>
            <th class="px-4 py-3 text-left">Job</th>
            <th class="px-4 py-3 text-left">Scheduled</th>
            <th class="px-4 py-3 text-left">Type</th>
            <th class="px-4 py-3 text-right">Actions</th>
        </tr>
    </thead>

    <tbody class="divide-y divide-slate-200">

        @foreach($interviews as $interview)
        <tr class="hover:bg-slate-50">

            <td class="px-4 py-3 font-semibold">
                {{ $interview->application->candidate->first_name }}
                {{ $interview->application->candidate->last_name }}
            </td>

            <td class="px-4 py-3">
                {{ $interview->application->candidate->email }}
            </td>

            <td class="px-4 py-3">
                {{ $interview->application->job->title ?? '-' }}
            </td>

            <td class="px-4 py-3">
                {{ $interview->scheduled_at->format('M d, Y, h:i A') }}
            </td>

            <td class="px-4 py-3">
                @php
                $typeStyles = [
                'zoom' => 'bg-sky-100 text-sky-700',
                'on_site' => 'bg-amber-100 text-amber-700',
                'phone' => 'bg-teal-100 text-teal-700',
                ];
                @endphp

                <span class="px-3 py-1 text-xs font-medium rounded-full
                    {{ $typeStyles[$interview->type] ?? 'bg-gray-100 text-gray-600' }}">
                    {{ ucfirst(str_replace('_', ' ', $interview->type)) }}
                </span>
            </td>

            <td class="px-4 py-3 text-right space-x-2">

                <a
                    class="text-sky-600 hover:underline">
                    View
                </a>

                <a
                    class="text-slate-600 hover:underline">
                    Reschedule
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
                No interviews scheduled yet.
            </td>
        </tr>
    </tbody>
    @endif

</x-table.card>

@endsection