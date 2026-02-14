@props([
'type' => 'button',
'variant' => 'primary', // primary | danger | secondary
])

@php
$baseClasses = '
inline-flex items-center justify-center
px-4 py-2 rounded-xl
font-semibold
transition
';

$variants = [
'primary' => 'bg-slate-900 text-white hover:bg-slate-800',
'danger' => 'bg-red-600 text-white hover:bg-red-700',
'secondary' => 'bg-slate-200 text-slate-800 hover:bg-slate-300',
];
@endphp

<button
    type="{{ $type }}"
    {{ $attributes->merge([
        'class' => $baseClasses . ' ' . $variants[$variant]
    ]) }}>
    {{ $slot }}
</button>