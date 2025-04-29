@props(['back' => null, 'utility', 'action'])

<div {{ $attributes->merge(['class' => 'font-bold text-gray-800 dark:text-white bg-gray-50 z-[50] dark:bg-gray-900 sticky top-[60px] py-1 mb-3']) }}>
    <div class="flex justify-between items-end flex-nowrap w-full">
        <div class="flex items-center space-x-3">
            @if (isset($back))
                <a href="{{ route($back) }}" class="hover:bg-gray-200 hover:dark:bg-slate-800/80 rounded-full" title="Kembali" wire:navigate>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 hover:stroke-slate-800/79 dark:hover:stroke-slate-300 m-2 stroke-slate-800 dark:stroke-slate-50">
                        <path fill-rule="evenodd" d="M11.03 3.97a.75.75 0 0 1 0 1.06l-6.22 6.22H21a.75.75 0 0 1 0 1.5H4.81l6.22 6.22a.75.75 0 1 1-1.06 1.06l-7.5-7.5a.75.75 0 0 1 0-1.06l7.5-7.5a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                      </svg>
                </a>
            @endif
            @if(isset($action))
                {{ $action }}
            @endif
            <h5>
                {{ $slot }}
            </h5>
        </div>

        @if (isset($utility))
            {{ $utility }}
        @endif
    </div>

    <hr class="border-1 border-gray-200 dark:border-gray-600 mt-3" />
</div>
