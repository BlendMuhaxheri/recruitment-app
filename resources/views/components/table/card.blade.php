@props([
'title' => null,
'subtitle' => null,
])

<div class="bg-white border border-slate-200 rounded-2xl p-6">

    @if($title)
    <h2 class="text-lg font-bold text-slate-900">
        {{ $title }}
    </h2>
    @endif

    @if($subtitle)
    <p class="text-sm text-slate-500 mb-4">
        {{ $subtitle }}
    </p>
    @endif

    <div class="overflow-x-auto mt-4">
        <table class="min-w-full text-sm">
            {{ $slot }}
        </table>
    </div>

</div>