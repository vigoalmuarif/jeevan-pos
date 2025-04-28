@props([
    'name' => '',
    'title' => ''
    ])

<div class="flex">
    <input type="checkbox"
        class="shrink-0 mt-0.5 border-gray-200 rounded text-primary-600 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-primary-500 dark:checked:border-primary-500 dark:focus:ring-offset-gray-800"
        id="{{ $name }}">
    <label for="{{ $name }}" class="text-sm text-gray-600 ms-3 dark:text-neutral-400">{{ $title }}</label>
</div>