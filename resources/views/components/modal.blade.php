@props([
    'hideClose' => false,
    'title' => 'Modal Title',
    'footer',
])
<div class="w-full" id="ini-modal">
    <div class="max-h-full flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
        <h6 class="font-bold text-gray-800 dark:text-white">
            {{ $title }}
        </h6>
        @if (!$hideClose)
            <button type="button"
                {{ $attributes->merge(['class' => 'size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400']) }}
                wire:click="$dispatch('closeModal')" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M18 6 6 18"></path>
                    <path d="m6 6 12 12"></path>
                </svg>
            </button>
        @endif
    </div>
    <div class="p-4 overflow-y-auto max-h-[70vh] scrollbar-thin">
        {{ $slot }}
    </div>
    <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t dark:border-neutral-700">
        @if (isset($footer))
            {{ $footer }}
        @endif
    </div>
</div>


