<div class="">
    <div class="p-3">
        <x-table.search class="w-full md:max-w-4xl justify-self-center mb-2" placeholder="Cari nama barang / sku"
            wire:model.live.debounce.700ms="search" />
        <div class="py-4">
            <div class="relative px-6"
                data-hs-scroll-nav='{
                    "autoCentering": true
                    }'>
                <nav class="hs-scroll-nav-body flex flex-nowrap gap-x-5 overflow-x-auto snap-x snap-mandatory">
                    <button type="button"
                        class="snap-start inline-flex  min-w-32 flex-nowrap @if ($setCategory == null) bg-primary-700/70 @else bg-slate-100 dark:bg-slate-800 @endif rounded-xl items-center gap-x-2 py-2 px-3 text-sm whitespace-nowrap font-medium text-center group"
                        wire:click="selectedCategory({{ null }})" wire:loading.attr="disabled">
                        <div class="bg-slate-200/60 rounded-lg dark:bg-neutral-900 p-1">
                            <svg class="shrink-0 size-7 @if ($setCategory == null) stroke-primary-500 @else group-hover:stroke-primary-500 @endif "
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <rect width="14" height="20" x="5" y="2" rx="2" ry="2"></rect>
                                <path d="M12 18h.01"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-700 dark:text-slate-200 ">Semua</p>
                            <p
                                class="text-xs font-medium  text-left @if ($setCategory == null) text-slate-300 @else text-slate-500 dark:text-slate-400 @endif">
                                {{ $categories->sum('products_count') }} item</p>
                        </div>
                    </button>
                    @foreach ($categories as $category)
                        <button type="button"
                            class="snap-start inline-flex  min-w-32 flex-nowrap @if ($setCategory == $category->id) bg-primary-700/70 @else bg-slate-100 dark:bg-slate-800 @endif rounded-xl items-center gap-x-2 py-2 px-3 text-sm whitespace-nowrap font-medium text-center group"
                            wire:key="category-{{ $category->id }}" wire:click="selectedCategory({{ $category->id }})"
                            wire:loading.attr="disabled">
                            <div class="bg-slate-200/60 rounded-lg dark:bg-neutral-900 p-1">
                                <svg class="shrink-0 size-7 @if ($setCategory == $category->id) stroke-primary-500 @else group-hover:stroke-primary-500 @endif "
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <rect width="14" height="20" x="5" y="2" rx="2" ry="2">
                                    </rect>
                                    <path d="M12 18h.01"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-700 dark:text-slate-200 ">
                                    {{ $category->name }}</p>
                                <p
                                    class="text-xs font-medium  text-left @if ($setCategory == $category->id) text-slate-300 @else text-slate-500 dark:text-slate-400 @endif">
                                    {{ $category->products_count }} item</p>
                            </div>
                        </button>
                    @endforeach
                </nav>

                <button type="button"
                    class="hs-scroll-nav-prev hs-scroll-nav-disabled:opacity-50 hs-scroll-nav-disabled:pointer-events-none absolute inset-y-0 start-0 inline-flex justify-center items-center text-gray-800 hover:bg-gray-800/10 focus:outline-hidden focus:bg-gray-800/10 rounded-s-lg dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                    <span class="text-2xl" aria-hidden="true">
                        <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
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
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6"></path>
                        </svg>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="relative overflow-y-auto h-[calc(100vh-265px)]">
        <div
            class="grid grid-cols-1 px-2.5 lg:grid-cols-2 2xl:grid-cols-3 4xl:grid-cols-4 gap-4 pb-6 place-content-start overflow-y-auto  scrollbar-thin">
            @forelse ($products as $product)
                <div
                    class="bg-white border border-gray-200 hover:border-primary-400 rounded-xl flex flex-col shadow-2xs dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                    <div class="flex">
                        <div
                            class="shrink-0 h-20 md:h-28 self-center md:self-start overflow-hidden  p-1.5 w-20 md:w-32">
                            <img class="w-full h-full rounded-lg object-cover"
                                src="{{ asset('storage/images/products/' . $product->profile_product_filename) }}"
                                alt="Card Image">
                        </div>
                        <div class="p-2 w-full">
                            <p class="font-semibold text-slate-700 dark:text-slate-200 mb-1">{{ $product->name }} Lorem
                                ipsum
                                dolor
                                sit amet consectetur.</p>
                            @foreach (collect($product->prices)->unique('product_unit_id') as $unit)
                                <x-badge
                                    color="{{ $units[$product->id] === $unit->product_unit_id ? 'primary' : 'secondary' }}"
                                    label="{{ $unit->unit->name }}" class="cursor-pointer hover:text-primary-500"
                                    role="button"
                                    wire:click="selectedSatuan({{ $product->id }}, {{ $unit->product_unit_id }})" />
                            @endforeach
                            <p
                                class="font-normal text-xs line-through decoration-slate-200/40 text-slate-500 dark:text-slate-400 mt-2">
                                Rp . 3.500.000
                                <x-badge color="success" label="2% OFF" class="bg-transparent dark:bg-transparent" />
                            </p>
                        </div>
                    </div>
                    {{-- tampilkan jika tablet --}}
                    <div class="px-2">
                        <!-- Input Number -->
                        <div class="mb-2.5 pe-2 bg-slate-200/60 rounded-lg dark:bg-neutral-900 dark:border-neutral-700"
                            data-hs-input-number="">
                            <div class="w-full flex flex-wrap justify-between items-center md:space-x-3 space-y-3">
                                <div class="">
                                    <span class="block font-medium text-xs text-gray-400">
                                        Harga
                                    </span>
                                    <span class="block text-sm text-gray-700 dark:text-neutral-300">
                                        Rp {{ number_format($prices[$product->id], '0', '.', ',') }}
                                    </span>
                                </div>
                                <div class="flex flex-wrap items-center self-end gap-x-1.5">
                                    <button type="button"
                                        class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                                        tabindex="-1" wire:click="descreaseQty({{ $product->id }})"
                                        wire:target="descreaseQty({{ $product->id }})" wire:loading.attr="disabled">
                                        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M5 12h14"></path>
                                        </svg>
                                    </button>
                                    <input
                                        class="p-0 w-8 qty-product bg-transparent select-all border-0 text-sm text-gray-800 text-center focus:ring-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none dark:text-white"
                                        style="-moz-appearance: textfield;" max="10000"
                                        x-model="$wire.entangle('quantities.{{ $product->id }}')"
                                        wire:change="updateQty({{ $product->id }}, $event.target.value)"
                                       >
                                    <button type="button"
                                        class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                                        tabindex="-1" @click="$wire.quantities.{{ $product->id }}++"
                                        wire:target="increaseQty({{ $product->id }})" wire:loading.attr="disabled">
                                        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M5 12h14"></path>
                                            <path d="M12 5v14"></path>
                                        </svg>
                                    </button>
                                    {{-- <div class="self-center"> --}}
                                    <x-button type="button" class="btnPrimary py-1 ms-2 hidden md:block"
                                        wire:click="addToCart({{ $product->id }})"
                                        wire:target="descreaseQty, increaseQty, addToCart, quantities"
                                        wire:loading.attr="disabled">
                                        <x-slot:loading wire:target="addToCart({{ $product->id }})">
                                            Adding...
                                        </x-slot:loading>
                                        <x-slot:default wire:target="addToCart({{ $product->id }})">
                                            Add
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                            </svg>

                                        </x-slot:default>
                                    </x-button>
                                    {{-- </div> --}}
                                </div>
                                <x-button type="button" class="btnPrimary py-1  w-full  md:hidden"
                                    wire:click="addToCart({{ $product->id }})"
                                    wire:target="descreaseQty, increaseQty, addToCart, quantities"
                                    wire:loading.attr="disabled">
                                    <x-slot:loading wire:target="addToCart({{ $product->id }})">
                                        Adding...
                                    </x-slot:loading>
                                    <x-slot:default wire:target="addToCart({{ $product->id }})">
                                        Add
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                        </svg>

                                    </x-slot:default>
                                </x-button>
                            </div>
                        </div>
                        <!-- End Input Number -->
                    </div>
                </div>
            @empty
            <div class="col-span-12 flex flex-col items-center justify-center space-y-4 h-[calc(100vh-500px)]">
                <img src="{{ asset('assets/media/img/relax.png') }}" class="w-32 md:w-60 self-center" alt="no product">
                <p class="absolute inset-x-0 top-1/2 transform -translate-y-1/2 text-center align-middle">Produk tidak ditemukan</p>
            </div>
            @endforelse
            <div wire:loading wire:target="loadMore" class="text-center mt-4">
                <p>Loading more products...</p>
            </div>
        </div>
        <div class="absolute top-0 start-0 size-full bg-white/50 rounded-lg dark:bg-neutral-800/40" wire:loading
            wire:target="search, selectedCategory"></div>

        <div class="absolute top-1/2 start-1/2 transform -translate-x-1/2 -translate-y-1/2" wire:loading
            wire:target="search, selectedCategory">
            <div class="w-10 h-10 border-4 border-t-primary-500 border-gray-300 rounded-full animate-spin"></div>

        </div>
    </div>
</div>
@script
    <script>
        $('.qty-product').on('click', function() {
            $(this).select();
        });
    </script>
@endscript
