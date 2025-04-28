    <div class="relative px-6" data-hs-scroll-nav='{
            "autoCentering": true
            }'>
        <nav class="hs-scroll-nav-body flex flex-nowrap gap-x-5 overflow-x-auto snap-x snap-mandatory">
            <button type="button"
                class="snap-start category category-active-default inline-flex  min-w-32 flex-nowrap @if ($selectedCategory == null) bg-primary-700/70 @else bg-slate-200 dark:bg-slate-800 @endif rounded-xl items-center gap-x-2 py-2 px-3 text-sm whitespace-nowrap font-medium text-center group"
                onclick="selectedCategory()">
                <div class="bg-white rounded-lg dark:bg-neutral-900 p-1">
                    <svg id="iconCategory"
                        class="shrink-0 size-7 icon-category @if ($selectedCategory == null) stroke-primary-500 @else group-hover:stroke-primary-500 @endif "
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <rect width="14" height="20" x="5" y="2" rx="2" ry="2"></rect>
                        <path d="M12 18h.01"></path>
                    </svg>
                </div>
                <div>
                    <p
                        class="text-sm font-semibold category-title category-active-title-default text-white dark:text-slate-200 ">
                        Semua</p>
                    <p
                        class="text-xs category-total category-total-active-default font-medium  text-left @if ($selectedCategory == null) text-slate-200 dark:text-slate-400 @else text-slate-500 dark:text-slate-400 @endif">
                        {{ $categories->sum('allocated_products_count') }} item</p>
                </div>
            </button>
            @foreach ($categories as $category)
                <button type="button"
                    class="snap-start category category{{ $category->id }} inline-flex   flex-nowrap @if ($selectedCategory == $category->id) bg-primary-700/70 @else bg-slate-200 dark:bg-slate-800 @endif rounded-xl items-center gap-x-2 py-2 px-3 text-sm whitespace-nowrap font-medium text-center group"
                    onclick="selectedCategory({{ $category->id }})">
                    <div class="bg-white rounded-lg dark:bg-neutral-900 p-1">
                        <svg id="iconCategory{{ $category->id }}"
                            class="shrink-0 icon-category size-7 @if ($selectedCategory == $category->id) stroke-primary-500 @else group-hover:stroke-primary-500 stroke-slate-200 @endif "
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <rect width="14" height="20" x="5" y="2" rx="2" ry="2">
                            </rect>
                            <path d="M12 18h.01"></path>
                        </svg>
                    </div>
                    <div>
                        <p
                            class="text-sm font-semibold category-title category-title-active-{{ $category->id }} text-slate-700 dark:text-slate-200 ">
                            {{ $category->name }}</p>
                        <p
                            class="text-xs font-medium category-total category-total-active-{{ $category->id }}  text-left @if ($selectedCategory == $category->id) text-slate-200 @else text-slate-500 dark:text-slate-400 @endif">
                            {{ $category->allocated_products_count }} item</p>
                    </div>
                </button>
            @endforeach
        </nav>

        <button type="button"
            class="hs-scroll-nav-prev hs-scroll-nav-disabled:opacity-50 hs-scroll-nav-disabled:pointer-events-none absolute inset-y-0 start-0 inline-flex justify-center items-center text-gray-800 hover:bg-gray-800/10 focus:outline-hidden focus:bg-gray-800/10 rounded-s-lg dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
            <span class="text-2xl" aria-hidden="true">
                <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="m15 18-6-6 6-6"></path>
                </svg>
            </span>
            <span class="sr-only">Previous</span>
        </button>
        <button type="button"
            class="hs-scroll-nav-next hs-scroll-nav-disabled:opacity-50 hs-scroll-nav-disabled:pointer-events-none absolute inset-y-0 end-0 inline-flex justify-center items-center text-gray-800 hover:bg-gray-800/10 focus:outline-hidden focus:bg-gray-800/10 rounded-e-lg dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
            <span class="sr-only">Next</span>
            <span class="text-2xl" aria-hidden="true">
                <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="m9 18 6-6-6-6"></path>
                </svg>
            </span>
        </button>
    </div>
