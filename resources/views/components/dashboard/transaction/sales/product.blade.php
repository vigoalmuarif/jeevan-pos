@props(['products'])

<div class="">
    <div class="p-3">
        {{-- <x-table.search class="w-full md:max-w-4xl justify-self-center mb-2" placeholder="Cari nama barang / sku" /> --}}
        <div class="py-4">
            {{-- <x-dashboard.transaction.cashier.category :categories="$categories" /> --}}
        </div>
    </div>
    <div class="relative overflow-y-auto h-[calc(100vh-265px)]">
        <div
            class="grid grid-cols-1 px-2.5 lg:grid-cols-2 2xl:grid-cols-3 4xl:grid-cols-4 gap-4 pb-6 place-content-start overflow-y-auto  scrollbar-thin">
            @forelse ($products as $product)
                @php
                    $sortedUnits = $product->product_unit_conversions->sortBy('conversion_factor');
                    $sortedPrices = $product->prices->sortBy('selling_price')->unique('product_unit_id');
                    $defaultUnit = $sortedUnits->first();
                    $defaultPrice = $sortedPrices
                        ->where('product_unit_id', $defaultUnit->pivot->product_unit_id)
                        ->first();
                @endphp
                {{-- @dd($sortedPrices); --}}
                <div
                    class="bg-white border border-gray-200 hover:border-primary-400 rounded-xl flex flex-col shadow-2xs dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                    <div class="flex">
                        <div class="shrink-0 h-20 md:h-28 self-center md:self-start overflow-hidden  p-1.5 w-20 md:w-32">
                            <img class="w-full h-full rounded-lg object-cover"
                                src="{{ asset('storage/images/products/' . $product->profile_product_filename) }}"
                                alt="Card Image">
                        </div>
                        <div class="p-2 w-full">
                            <p class="font-semibold text-slate-700 dark:text-slate-200 mb-1">{{ $product->name }} Lorem
                                ipsum
                                dolor
                                sit amet consectetur.</p>
                            @foreach ($sortedPrices as $unit)
                                <span
                                    class="cursor-pointer {{ $defaultUnit->pivot->product_unit_id === $unit->product_unit_id ? 'bg-primary-700/40' : 'bg-slate-300/40 dark:bg-gray-800/40' }} hover:text-primary-500 handle-unit inline-flex items-center gap-x-1.5 py-0.5 px-3 rounded-full text-xs font-medium text-primary-600 dark:text-primary-400"
                                    role="button" data-product="{{ $product->id }}"
                                    data-unit="{{ $unit->product_unit_id }}" data-price="{{ $unit->selling_price }}">
                                    {{ $unit->unit->name }}
                                </span>
                            @endforeach
                            <input type="hidden" class="unitSelected{{ $product->id }}"
                                value="{{ $defaultUnit->pivot->product_unit_id }}" name="unitSelected"
                                id="unitSelected">
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
                                    <span class="block text-sm text-gray-700 dark:text-neutral-300"
                                        id="price-{{ $product->id }}">
                                        Rp {{ number_format($defaultPrice->selling_price ?? 0, '0', '.', ',') }}
                                    </span>
                                </div>
                                <div class="flex flex-wrap items-center self-end gap-x-1.5">
                                    <button type="button"
                                        class="descreasQty size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                                        tabindex="-1" aria-label="Decrease" data-hs-input-number-decrement=""
                                        data-product="{{ $product->id }}">
                                        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M5 12h14"></path>
                                        </svg>
                                    </button>
                                    <input
                                        class="qty-{{ $product->id }} qty-product p-0 w-8 bg-transparent border-0 text-gray-800 text-center focus:ring-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none dark:text-white"
                                        style="-moz-appearance: textfield;" type="number"
                                        aria-roledescription="Number field" value="1" :min="1"
                                        data-hs-input-number-input="" onclick="this.select();">
                                    <button type="button"
                                        class="increasQty size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                                        tabindex="-1" aria-label="Increase" data-hs-input-number-increment=""
                                        data-product="{{ $product->id }}">
                                        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M5 12h14"></path>
                                            <path d="M12 5v14"></path>
                                        </svg>
                                    </button>
                                    {{-- <div class="self-center"> --}}
                                    <button type="button"
                                        class="btnPrimary py-1 ms-2 hidden md:inline-flex add-to-cart handleAddToCart{{ $product->id }}"
                                        data-product="{{ $product->id }}">
                                        Add
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                        </svg>
                                    </butt>
                                    {{-- </div> --}}
                                </div>
                                <x-button type="button" class="btnPrimary py-1  w-full  md:hidden">
                                    <x-slot:loading>
                                        Adding...
                                    </x-slot:loading>
                                    <x-slot:default>
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
                    <img src="{{ asset('assets/media/img/relax.png') }}" class="w-32 md:w-60 self-center"
                        alt="no product">
                    <p class="absolute inset-x-0 top-1/2 transform -translate-y-1/2 text-center align-middle">Produk
                        tidak ditemukan</p>
                </div>
            @endforelse
            {{-- <div wire:loading wire:target="loadMore" class="text-center mt-4">
                <p>Loading more products...</p>
            </div> --}}
        </div>
        {{-- <div class="absolute top-0 start-0 size-full bg-white/50 rounded-lg dark:bg-neutral-800/40" wire:loading
            wire:target="search, selectedCategory"></div>

        <div class="absolute top-1/2 start-1/2 transform -translate-x-1/2 -translate-y-1/2" wire:loading
            wire:target="search, selectedCategory">
            <div class="w-10 h-10 border-4 border-t-primary-500 border-gray-300 rounded-full animate-spin"></div>

        </div> --}}
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.handle-unit').click(function() {
            let productID = $(this).data('product');
            let price = $(this).data('price');
            let unit = $(this).data('unit');

            $(`.handle-unit[data-product="${productID}"]`).removeClass("bg-primary-700/40").addClass(
                "bg-slate-300/40 dark:bg-gray-800/40");
            $(this).removeClass("bg-slate-300/40 dark:bg-gray-800/40").addClass(
                "bg-primary-700/30 text-white");
            $(`#price-${productID}`).text('Rp' + ' ' + new Intl.NumberFormat('id-ID').format(price));
            $(`.qty-${productID}`).val(1)
            $(`.unitSelected${productID}`).val(unit)
        })

        $('.increasQty').on('click', function(e) {
            e.preventDefault();
            let product = $(this).data('product');
            let qty = parseInt($(`.qty-${product}`).val()) || 1; // Jika null, default ke 0
            $(`.qty-${product}`).val(qty + 1);
        })
        $('.descreasQty').on('click', function(e) {
            e.preventDefault();
            let productID = $(this).data('product');
            let qty = parseInt($(`.qty-${productID}`).val()) || 1; // Jika null, default ke 0
            $(`.qty-${productID}`).val(qty == 1 ? 1 : qty - 1);
        })
        $('.qty-product').on('change', function(e) {
            e.preventDefault();
            if ($(this).val() == 0 || $(this).val() == null) {
                $(this).val(1)
            }
        })
        $('.add-to-cart').on('click', function(e) {
            e.preventDefault();
            let productID = $(this).data('product');
            let price = $(`#price-${productID}`).text();
            let unit = $(`.unitSelected${productID}`).val();
            let qty = $(`.qty-${productID}`).val();
            $.ajax({
                url: '{{ route('dashboards.cashier.add_to_cart') }}',
                type: 'get',
                data: {
                    product: productID,
                    price: price,
                    unit: unit,
                    qty: qty
                },
                beforeSend:function(){
                    $(`.handleAddToCart${productID}`).prop('disabled', true);
                },
                success: function(response) {
                    if (response.status === true) {
                        $.ajax({
                            url: '{{ route('dashboards.cashier.carts') }}',
                            type: 'get',
                            success: function(response) {
                                $('.carts').html(response);
                                // Efek smooth scroll ke bawah
                                $('.product-cart-container').scrollTop($('.carts')[0].scrollHeight);
                            }
                        })

                    } else {
                        Toastify({
                            text: response.message,
                            duration: 5000,
                            close: true,
                            gravity: "top", // `top` or `bottom`
                            position: "right", // `left`, `center` or `right`
                            stopOnFocus: true, // Prevents dismissing of toast on hover
                            style: {
                                background: "#f59e0b",
                                borderRadius: "12px",
                            },
                            onClick: function() {} // Callback after click
                        }).showToast();
                    }
                },
                complete:function(){
                    $(`.handleAddToCart${productID}`).prop('disabled', false);
                },

            })
        })
    })
</script>
