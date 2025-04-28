<div class="relative">
    <x-card-basic class="p-4">
        <div>
            <div class="grid grid-cols-1 lg:grid-cols-12 sm:gap-x-0 lg:gap-8">
                <!-- Slider left -->
                <div class="md:col-span-5 hidden lg:block" data-hs-carousel='{
    "loadingClasses": "opacity-0"
  }'
                    class="relative">
                    <div class="hs-carousel flex space-x-2">
                        <div class="flex-none">
                            <div
                                class="hs-carousel-pagination max-h-96 flex flex-col gap-y-2 overflow-y-auto overflow-x-hidden pe-3 scrollbar-thin">
                                <div
                                    class="hs-carousel-pagination-item shrink-0 border rounded-xl overflow-hidden cursor-pointer w-[100px] h-[100px] hs-carousel-active:border-blue-400">
                                    <div class="flex justify-center h-full bg-gray-100 p-0.5 dark:bg-neutral-900">
                                        @if ($product->profile_product_filename)
                                            <img src="{{ asset('storage/images/products/' . $product->profile_product_filename) }}"
                                                class="rounded-lg object-cover" alt="{{ $product->name }}">
                                        @else
                                            <img src="{{ asset('assets/media/img/no_image.png') }}" alt="">
                                        @endif
                                    </div>
                                </div>
                                @foreach ($product->images as $image)
                                    <div
                                        class="hs-carousel-pagination-item shrink-0 border rounded-xl overflow-hidden cursor-pointer w-[100px] h-[100px] hs-carousel-active:border-blue-400">
                                        <div class="flex justify-center h-full bg-gray-200 p-2 dark:bg-neutral-800">
                                            <img src="{{ asset('storage/images/products/' . $image->filename) }}"
                                                class="rounded-lg object-cover" alt="{{ $product->name }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="relative grow overflow-hidden w-40 h-96 bg-white rounded-xl">
                            <div
                                class="hs-carousel-body absolute top-0 bottom-0 start-0 flex flex-nowrap transition-transform duration-700 opacity-0">
                                <div class="hs-carousel-slide">
                                    <div class="flex justify-center h-full bg-gray-100 p-2 dark:bg-neutral-900">
                                        @if ($product->profile_product_filename)
                                            <img src="{{ asset('storage/images/products/' . $product->profile_product_filename) }}"
                                                class="rounded-lg object-contain" alt="{{ $product->name }}">
                                        @else
                                            <img src="{{ asset('assets/media/img/no_image.png') }}"
                                                class="rounded-lg object-contain" alt="no-image">
                                        @endif
                                    </div>
                                </div>
                                @foreach ($product->images as $image)
                                    <div class="hs-carousel-slide">
                                        <div class="flex justify-center h-full bg-gray-200 p-6 dark:bg-neutral-800">
                                            <img src="{{ asset('storage/images/products/' . $image->filename) }}"
                                                class="rounded-xl object-contain" alt="{{ $product->name }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <button type="button"
                                class="hs-carousel-prev hs-carousel-disabled:opacity-50 hs-carousel-disabled:pointer-events-none absolute inset-y-0 start-0 inline-flex justify-center items-center w-[46px] h-full text-gray-800 hover:bg-gray-800/10 focus:outline-none focus:bg-gray-800/10 rounded-s-lg dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                                <span class="text-2xl" aria-hidden="true">
                                    <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m15 18-6-6 6-6"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">Previous</span>
                            </button>
                            <button type="button"
                                class="hs-carousel-next hs-carousel-disabled:opacity-50 hs-carousel-disabled:pointer-events-none absolute inset-y-0 end-0 inline-flex justify-center items-center w-[46px] h-full text-gray-800 hover:bg-gray-800/10 focus:outline-none focus:bg-gray-800/10 rounded-e-lg dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                                <span class="sr-only">Next</span>
                                <span class="text-2xl" aria-hidden="true">
                                    <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m9 18 6-6-6-6"></path>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- End Slider -->

                <!-- Slider -->
                <div class="sm:col-span-12 md:col-span-5 mb-3 block lg:hidden"
                    data-hs-carousel='{
    "loadingClasses": "opacity-0"
  }' class="relative">
                    <div class="hs-carousel relative overflow-hidden w-full min-h-96 bg-white rounded-lg">
                        <div
                            class="hs-carousel-body absolute top-0 bottom-0 start-0 flex flex-nowrap transition-transform duration-700 opacity-0">
                            <div class="hs-carousel-slide">
                                <div class="flex justify-center h-full bg-gray-100 p-6 dark:bg-neutral-900">
                                    @if ($product->profile_product_filename)
                                        <img src="{{ asset('storage/images/products/' . $product->profile_product_filename) }}"
                                            class="rounded-lg object-contain" alt="{{ $product->name }}">
                                    @else
                                        <img src="{{ asset('assets/media/img/no_image.png') }}" alt="">
                                    @endif
                                </div>
                            </div>
                            @foreach ($product->images as $image)
                                <div class="hs-carousel-slide">
                                    <div class="flex justify-center h-full bg-gray-200 p-6 dark:bg-neutral-800">
                                        <img src="{{ asset('storage/images/products/' . $image->filename) }}"
                                            class="rounded-lg object-contain" alt="{{ $product->name }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div
                            class="hs-carousel-pagination absolute bottom-3 start-0 w-full overflow-x-auto scrollbar-thin">
                            <div class="flex flex-row items-center gap-x-2 px-2">

                                <div
                                    class="hs-carousel-pagination-item shrink-0 border rounded-md overflow-hidden cursor-pointer w-[80px] h-[80px] hs-carousel-active:border-blue-400">
                                    <div class="flex justify-center h-full bg-gray-100 p-2 dark:bg-neutral-900">
                                        @if ($product->profile_product_filename)
                                            <img src="{{ asset('storage/images/products/' . $product->profile_product_filename) }}"
                                                class="rounded-lg object-cover" alt="{{ $product->name }}">
                                        @else
                                            <img src="{{ asset('assets/media/img/no_image.png') }}" alt="">
                                        @endif
                                    </div>
                                </div>
                                @foreach ($product->images as $image)
                                    <div
                                        class="hs-carousel-pagination-item shrink-0 border rounded-md overflow-hidden cursor-pointer w-[80px] h-[80px] hs-carousel-active:border-blue-400">
                                        <div class="flex justify-center h-full bg-gray-200 p-2 dark:bg-neutral-800">
                                            <img src="{{ asset('storage/images/products/' . $image->filename) }}"
                                                class="rounded-lg object-cover" alt="{{ $product->name }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <button type="button"
                            class="hs-carousel-prev hs-carousel-disabled:opacity-50 hs-carousel-disabled:pointer-events-none absolute inset-y-0 start-0 inline-flex justify-center items-center w-[46px] h-full text-gray-800 hover:bg-gray-800/10 focus:outline-none focus:bg-gray-800/10 rounded-s-lg dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                            <span class="text-2xl" aria-hidden="true">
                                <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m15 18-6-6 6-6"></path>
                                </svg>
                            </span>
                            <span class="sr-only">Previous</span>
                        </button>
                        <button type="button"
                            class="hs-carousel-next hs-carousel-disabled:opacity-50 hs-carousel-disabled:pointer-events-none absolute inset-y-0 end-0 inline-flex justify-center items-center w-[46px] h-full text-gray-800 hover:bg-gray-800/10 focus:outline-none focus:bg-gray-800/10 rounded-e-lg dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                            <span class="sr-only">Next</span>
                            <span class="text-2xl" aria-hidden="true">
                                <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>
                            </span>
                        </button>
                    </div>
                </div>
                <!-- End Slider -->

                {{-- detail --}}
                <div class="md:col-span-7">
                    <div class="mb-7">
                        <h5 class="">{{ $product->name }}</h5>
                        <x-badge color="{{ $product->status == 1 ? 'success' : 'danger' }}"
                            label="{{ $product->status == 1 ? 'Active' : 'Inactive' }}" />
                    </div>
                    <div class="flex flex-col space-y-5 divide-y divide-slate-200/80 dark:divide-slate-800">

                        <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
                            <div class="flex flex-col">
                                <p class="text-xs">SKU</p>
                                <p class="text-base font-semibold">{{ $product->sku }}</p>
                            </div>
                            <div class="flex flex-col">
                                <p class="text-xs">Brand</p>
                                <p class="text-base font-semibold">{{ $product->brand->name }}</p>
                            </div>
                            <div class="flex flex-col">
                                <p class="text-xs">Gudang</p>
                                <p class="text-base font-semibold">{{ $product->warehouse->name }}</p>
                            </div>
                            <div class="flex flex-col">
                                <p class="text-xs">Supplier</p>
                                <p class="text-base font-semibold">{{ $product->supplier->name }}</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2  gap-5 pt-5">
                            <div class="flex flex-col">
                                <p class="text-xs">Kategori</p>
                                <div>
                                    @foreach ($product->categories as $category)
                                        <x-badge label="{{ $category->name }}" />
                                    @endforeach
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <p class="text-xs">Barcode</p>
                                <p class="text-base font-semibold">{{ $product->barcode ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 pt-5">
                            <div class="flex flex-col">
                                <p class="text-xs">Sat. Besar/Gudang</p>
                                <p class="text-base font-semibold">{{ $product->base_warehouse_unit->name }}</p>
                            </div>
                            <div class="flex flex-col">
                                <p class="text-xs">Sat. Terkecil Yang Dijual</p>
                                <p class="text-base font-semibold">{{ $product->base_unit->name }}</p>
                            </div>
                            <div class="flex flex-col">
                                <p class="text-xs">Harga Beli Sat. Kecil</p>
                                <p class="text-base font-semibold">Rp.
                                    {{ number_format($product->base_cost_price, 0, '.', ',') }}</p>
                            </div>
                            <div class="flex flex-col">
                                <p class="text-xs">Harga Jual Sat. Kecil</p>
                                <p class="text-base font-semibold">Rp.
                                    {{ number_format($product->base_selling_price, 0, '.', ',') }}</p>
                            </div>
                            <div class="flex flex-col">
                                <p class="text-xs">Total Stok</p>
                                <p class="text-base font-semibold">
                                    @if($product->base_warehouse_unit_id === $product->base_unit_id)
                                    {{ floor(($total_stock->qty_akhir ?? 0) / $product->index) .' '. $product->base_warehouse_unit->name }}
                                    @else
                                    {{ floor(($total_stock->qty_akhir ?? 0) / $product->index) .' '. $product->base_warehouse_unit->name .' , '. ($total_stock->qty_akhir ?? 0) % $product->index .' '. $product->base_unit->name }}
                                    @endif
                                </p>
                            </div>
                            <div class="flex flex-col">
                                <p class="text-xs">Minimal Stok</p>
                                <p class="text-base font-semibold">{{ $product->min_stock }}</p>
                            </div>
                            <div class="flex flex-col">
                                <p class="text-xs">Jual Online</p>
                                <p class="text-base font-semibold">{{ $product->sell_online == 1 ? 'Ya' : 'Tidak' }}</p>
                            </div>
                        </div>
                        <div class="pt-5 text-sm text-slate-500">
                            <div class="font-semibold text-sm mb-2">Deskripsi</div>
                            {{ $product->desc }}
                        </div>
                    </div>
                    <div class="w-full mt-16">
                        <x-button type="submit" class="btnPrimary w-full" wire:target="save">
                            <x-slot:loading wire:target="save">
                                Memuat...
                            </x-slot:loading>
                            <x-slot:default wire:target="save">
                                Ubah
                            </x-slot:default>
                        </x-button>

                    </div>
                </div>
            </div>
        </div>

    </x-card-basic>
</div>
