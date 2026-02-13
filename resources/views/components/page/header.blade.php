@props([
'title',
'subtitle' => null,
'buttonText' => null,
'buttonLink' => null,
])

<div class="flex items-center justify-between mb-6">

    {{-- Left Side: Title + Subtitle --}}
    <div>
        <h1 class="text-2xl font-bold text-slate-900">
            {{ $title }}
        </h1>

        @if($subtitle)
        <p class="text-sm text-slate-500 mt-1">
            {{ $subtitle }}
        </p>
        @endif
    </div>

    {{-- Right Side: Button --}}
    @if($buttonText && $buttonLink)
    <a href="{{ $buttonLink }}">
        <x-form.button>
            {{ $buttonText }}
        </x-form.button>
    </a>
    @endif

</div>