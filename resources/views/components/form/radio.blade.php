@props([
    'label' => '',
    'name' => '',
    'id' => '',
    'value' => '',
])

@error($name)
    @php
        $style =
            'shrink-0 mt-0.5 border-gray-200 rounded-full text-red-600 focus:ring-red-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-red-500 dark:checked:border-red-500 dark:focus:ring-offset-gray-800';
    @endphp
@else
    @php
        $style =
            'shrink-0 mt-0.5 border-gray-200 rounded-full text-primary-600 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-primary-500 dark:checked:border-primary-500 dark:focus:ring-offset-gray-800';
    @endphp
@enderror
<div class="flex">
    <input type="radio" name="{{ $name }}" id="{{ $id }}" value="{{ $value }}"
        class="{{ $style }}" {{ $attributes }}>
    <label for="{{ $id }}" class="text-sm @error($name) text-red-500 dark:text-red-400  @else text-gray-700 dark:text-gray-200 @enderror ms-2">{{ $label }}</label>
</div>
