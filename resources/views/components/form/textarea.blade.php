@props([
'name',
'label' => null,
'placeholder' => '',
'rows' => 5,
'required' => false,
])

<div>
    @if($label)
    <label for="{{ $name }}" class="block text-sm font-medium text-slate-700 mb-1">
        {{ $label }}
        @if($required)
        <span class="text-red-500">*</span>
        @endif
    </label>
    @endif

    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="{{ $rows }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge([
            'class' => 'w-full rounded-lg border border-slate-300 px-4 py-2 text-sm
                        focus:ring-2 focus:ring-sky-500 focus:border-sky-500
                        transition duration-150 ease-in-out'
        ]) }}>{{ old($name) }}</textarea>

    @error($name)
    <p class="mt-1 text-sm text-red-600">
        {{ $message }}
    </p>
    @enderror
</div>