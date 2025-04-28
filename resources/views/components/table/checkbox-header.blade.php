@props(['id' => '', 'checked' => false])

<th scope="col" class="py-3 ps-4 w-10">
    <div class="flex items-center h-5">
        <input id="{{ $id }}" type="checkbox"
            {{ $attributes->merge([
                'class' => 'border-gray-200 rounded text-primary-600 focus:ring-primary-500 dark:bg-neutral-700 dark:border-neutral-500 dark:checked:bg-primary-500 dark:checked:border-primary-500 dark:focus:ring-offset-gray-800',
                'checked' => $checked ?? false,
                'disabled' => $disabled ?? false,
                'readonly' => $readonly ?? false
            ]) }}
            >
        <label for="{{ $id }}" class="sr-only">Checkbox</label>
    </div>
</th>
