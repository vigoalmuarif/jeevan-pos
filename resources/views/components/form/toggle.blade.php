@props([
    'label' => '',
    'desc' => '',
    'name' => 'toggle-switch',
    'id' => 'toggle-switch',
    'active' => false
])

<!-- Switch/Toggle -->
<div class="flex items-center">
  <!-- Switch/Toggle -->
<div class="relative inline-block">
    <input {{ $attributes }} type="checkbox" id="{{ $id }}" checked="{{ $active }}" class="peer relative w-11 h-6 p-px bg-gray-300/80 border-transparent text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-primary-600 disabled:opacity-50 disabled:pointer-events-none checked:bg-none checked:text-primary-600 checked:border-primary-600 focus:checked:border-primary-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-primary-500 dark:checked:border-primary-500 dark:focus:ring-offset-gray-600
  
    before:inline-block before:size-5 before:bg-white checked:before:bg-primary-200 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-primary-200">
    <label for="{{ $id }}" class="sr-only">switch</label>
    <span class="peer-checked:text-white text-gray-500 size-5 absolute top-[3px] start-0.5 flex justify-center items-center pointer-events-none transition-colors ease-in-out duration-200 dark:text-neutral-500">
      <svg class="shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <path d="M18 6 6 18"></path>
        <path d="m6 6 12 12"></path>
      </svg>
    </span>
    <span class="peer-checked:text-primary-600 text-gray-500 size-5 absolute top-[3px] end-0.5 flex justify-center items-center pointer-events-none transition-colors ease-in-out duration-200 dark:text-neutral-500">
      <svg class="shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="20 6 9 17 4 12"></polyline>
      </svg>
    </span>
  </div>
  <!-- End Switch/Toggle -->
    <label for="{{ $id }}"
        class="text-sm text-gray-500 ms-3 dark:text-neutral-400 inline-flex flex-col"><p class=" text-gray-700 dark:text-gray-200">{{ $label }}</p><p class="text-[11px] font-thin text-gray-500 dark:text-gray-400">{{ $desc }}</p></label>
</div>
<!-- End Switch/Toggle -->
