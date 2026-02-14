@props([
'label' => null,
'name',
'type' => 'text',
'placeholder' => '',
'value' => null,
])

<div>
    @if($label)
    <x-form.label :for="$name">
        {{ $label }}
    </x-form.label>
    @endif

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge([
            'class' =>
                'w-full rounded-xl border border-slate-200 px-3 py-2
                 focus:ring-4 focus:ring-slate-100 focus:border-slate-400
                 outline-none'
        ]) }}>

    <x-form.error :name="$name" />
</div>