    @props([
        'heading',
        'body',
        'action',
        'paginate',
        'loading' => false,
        'search' => true,
        'perPage' => true,
        'count' => 1,
        'tableLoading' => [],
        'refresh' => false,
        'rounded_top' => ''
    ])
    <div class="">
        <div class="flex flex-col-reverse md:flex-row justify-between px-2.5 @if($perPage == true && $search == true) pt-2 gap-y-4 mb-2  @else pt-0 mt-0 @endif  gap-x-2.5">
            <div class="flex flex-wrap">
                @if (isset($action))
                    <div
                        {{ $action->attributes->merge(['class' => 'flex flex-nowrap justify-center items-center gap-x-1.5']) }}>
                        {{ $action }}
                    </div>
                @endif
                @if ($perPage == true)
                    <select class="formSelect mx-3.5 border py-2 border-gray-200 dark:border-neutral-700 " name="perPage"
                        wire:model.live="perPage">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="75">75</option>
                        <option value="100">100</option>
                    </select>
                @endif
                @if ($refresh === true)
                    <x-button class="btnSecondary me-2" wire:click.prevent="refresh()" title="Refresh">
                        <x-slot:loading wire:target="refresh()">
                            
                        </x-slot:loading>
                        <x-slot:default wire:target="refresh()">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-4 stroke-slate-700 dark:stroke-slate-300">
                                <path fill-rule="evenodd"
                                    d="M4.755 10.059a7.5 7.5 0 0 1 12.548-3.364l1.903 1.903h-3.183a.75.75 0 1 0 0 1.5h4.992a.75.75 0 0 0 .75-.75V4.356a.75.75 0 0 0-1.5 0v3.18l-1.9-1.9A9 9 0 0 0 3.306 9.67a.75.75 0 1 0 1.45.388Zm15.408 3.352a.75.75 0 0 0-.919.53 7.5 7.5 0 0 1-12.548 3.364l-1.902-1.903h3.183a.75.75 0 0 0 0-1.5H2.984a.75.75 0 0 0-.75.75v4.992a.75.75 0 0 0 1.5 0v-3.18l1.9 1.9a9 9 0 0 0 15.059-4.035.75.75 0 0 0-.53-.918Z"
                                    clip-rule="evenodd" />
                            </svg>

                        </x-slot:default>
                    </x-button>
                @endif

            </div>
            @if ($search)
                <x-table.search placeholder="Search..." class="w-full" wire:model.live.debounce.700ms="search" />
            @endif
        </div>
        <div class="relative overflow-x-auto scrollbar-thin @if($rounded_top != '') {{ $rounded_top }} @else rounded-none @endif">
            <div class="min-w-full inline-block align-middle">
                <div class="@if($rounded_top != '') {{ $rounded_top }} @else rounded-none @endif dark:border-neutral-700 overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                        <thead class="bg-gray-50 dark:bg-neutral-700  sticky top-0">
                            {{ $heading }}
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700 ">
                            @if ($count == 0)
                                <tr class="">
                                    <td colspan="1000" class="text-center">
                                        <div
                                            class="flex flex-col items-center justify-center py-3 text-sm font-medium text-gray-900 dark:text-white w-full">
                                            <img src="{{ asset('assets/media/img/relax.png') }}"
                                                class="w-auto h-32 mb-2 bg-transparent" alt="no-data">
                                            <p>Oops, no data found!</p>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            {{ $body }}
                        </tbody>
                    </table>
                    @if (isset($paginate))
                        <div class="py-4 px-4">
                            {{ $paginate }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="absolute top-0 start-0 size-full bg-gray-300/40 rounded-none dark:bg-gray-800/50" wire:loading
                wire:target="search, perPage, {{ implode(',', $tableLoading) }}"></div>
            <div class="absolute top-1/2 start-1/2 transform -translate-x-1/2 -translate-y-1/2" wire:loading
                wire:target="search, perPage, {{ implode(',', $tableLoading) }}">
                <div class="animate-spin inline-block size-6 border-[3px] border-current border-t-transparent text-primary-600 rounded-full dark:text-primary-500"
                    role="status" aria-label="loading">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
    </div>
