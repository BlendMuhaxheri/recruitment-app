@props(['for', 'value'])

<label for="{{ $for }}" class="block text-sm font-medium mb-1">
    {{ $slot }}
</label>