@props([
    'placeholder' => ''
])

<div {{ $attributes->merge(['class' => 'w-full md:max-w-44 space-y-3 justify-self-end']) }}>
    <div>
        <label for="search-table" class="block text-sm font-medium mb-2 dark:text-white sr-only">Search</label>
        <div class="relative">
            <input type="search" {{ $attributes->merge([
                'id' => 'search-table',
                'name' => 'serach-table',
                'class' => 'py-2 px-2 ps-8 block w-full bg-gray-100 border-gray-300 shadow-sm rounded-xl text-sm focus:z-10 focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-isDark dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-primary-600',
                'placeholder' => $placeholder,
                'autocomplete' => 'off'
            ]) }} ">
            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-2.5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="shrink-0 size-4 text-gray-400 dark:text-neutral-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                  </svg>
            </div>
        </div>
    </div>
</div>
