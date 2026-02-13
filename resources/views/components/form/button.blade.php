@props([
'type' => 'button',
])

<button
    type="{{ $type }}"
    {{ $attributes->merge([
        'class' =>
            'inline-flex items-center justify-center
             bg-slate-900 text-white
             px-4 py-2 rounded-xl
             font-semibold
             hover:bg-slate-800
             transition'
    ]) }}>
    {{ $slot }}
</button>