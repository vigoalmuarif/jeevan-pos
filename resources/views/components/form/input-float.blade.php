@props([
    'label' => '',
    'name' => '',
    'id' => '',
    'rounded' => 'rounded-xl'
])
<!-- Floating Input -->
<div class="w-full">
    <div class="relative">
        <input {{ $attributes->merge([
            'type' => 'text',
        ]) }} id="{{ $id }}"
            name="{{ $name }}" class="@error($name) isInvalidFormInputFloat  @else formInputFloat @enderror  {{ $rounded }} peer"
            placeholder="Floating Input"
            autocomplete="off">
        <label for="{{ $id }}"
            class="absolute top-0 start-0 p-2.5 h-full text-sm font-medium truncate pointer-events-none transition ease-in-out duration-100 border border-transparent origin-[0_0] peer-disabled:opacity-50 peer-disabled:pointer-events-none
          peer-focus:scale-90
          peer-focus:translate-x-0.5
          peer-focus:-translate-y-1.5
          peer-focus:text-gray-500 dark:peer-focus:text-gray-300
          peer-[:not(:placeholder-shown)]:scale-90
          peer-[:not(:placeholder-shown)]:translate-x-0.5
          peer-[:not(:placeholder-shown)]:-translate-y-1.5
          peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-200 @error($name) text-red-500 dark:text-red-500 @else text-gray-600  dark:text-gray-200 @enderror">{{ $label }}</label>
    </div>
    @error($name)
        <p class="isInvalidMessage mt-0.5" id="error-msg-{{ $name }}">{{ $message }}</p>
    @enderror

</div>
<!-- End Floating Input -->
