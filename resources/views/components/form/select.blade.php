@props([
'name',
'label' => null,
'options' => [],
'value' => null,
'placeholder' => 'Select...',
])

<div>
    @if($label)
    <x-form.label :for="$name">
        {{ $label }}
    </x-form.label>
    @endif

    <select
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $attributes->merge([
            'class' => 'w-full rounded-lg border border-slate-300 px-4 py-2 focus:ring-2 focus:ring-slate-900 focus:outline-none'
        ]) }}>
        {{-- Default Placeholder --}}
        <option value="">
            {{ $placeholder }}
        </option>

        @foreach($options as $optionValue => $optionLabel)
        <option
            value="{{ $optionValue }}"
            @selected(old($name, $value)==$optionValue)>
            {{ $optionLabel }}
        </option>
        @endforeach
    </select>

    <x-form.error :name="$name" />
</div>