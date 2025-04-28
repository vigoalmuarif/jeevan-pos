    <div class="relative overflow-y-auto h-[calc(100vh-333px)]">
        <div
            class="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 4xl:grid-cols-4 gap-3  place-content-start overflow-y-auto  scrollbar-thin">
            <div class="bg-white h-full row-span-2 border p-2 border-gray-200 hover:border-primary-400 rounded-xl flex flex-col justify-center shadow-2xs dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70"
                style="display:none" id="scannCamera">
                <div class="w-96 md:w-full max-h-80 mx-auto rounded-lg overflow-hidden" id="reader"></div>
                <div class="flex justify-center pt-2">
                    <button type="button" id="stopScan" class="btnSecondary" disabled>Stop Scan</button>
                </div>
            </div>
            @forelse ($products as $product)
                <div
                    class="bg-white border border-gray-200 hover:border-primary-400 rounded-xl flex flex-col shadow-2xs dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                    <input type="hidden" name="warehouse_id" id="warehouseID" class="warehouse{{ $product->id }}"
                        value="{{ $cashier->warehouse_id }}" />
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
                            @foreach ($product->prices->unique('product_unit_id') as $index => $unit)
                                <span
                                    class="cursor-pointer {{ $index === 0 ? 'bg-primary-700/40' : 'bg-slate-300/40 dark:bg-gray-800/40' }} hover:text-primary-500 handle-unit inline-flex items-center gap-x-1.5 py-0.5 px-3 rounded-full text-xs font-medium text-primary-600 dark:text-primary-400"
                                    role="button" data-product="{{ $product->id }}"
                                    data-unit="{{ $unit->product_unit_id }}" data-price="{{ $unit->selling_price }}"
                                    data-warehouse="{{ $unit->warehouse_id }}"
                                    @php
$conversion_item = ($product->quantity * $product->stock_conversion_alocation ) / $unit->conversion->conversion_factor @endphp
                                    data-qty="{{ $unit->conversion->conversion_factor == 1 ? ceil($conversion_item) : floor($conversion_item) }}">
                                    {{ $unit->unit->name }}
                                </span>
                            @endforeach
                            <input type="hidden" class="unitSelected{{ $product->id }}"
                                value="{{ $product->prices[0]->product_unit_id }}" name="unitSelected"
                                id="unitSelected">
                            <div class="flex flex-nowrap justify-between items-center pt-2.5">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="size-5 stroke-2 inline-flex me-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                    </svg>
                                    @php
                                        $stock =
                                            ($product->quantity * $product->stock_conversion_alocation) /
                                            $product->prices[0]->conversion->conversion_factor;
                                    @endphp
                                    <p>Stok : <span
                                            class="stock-item row-stock-item{{ $product->id }} {{ $stock == 0 ? 'text-rose-600' : 'text-slate-600 dark:text-slate-300' }} ">{{  ceil($stock) }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- tampilkan jika tablet --}}
                    <div class="px-2">

                        <!-- Input Number -->
                        <div class="mb-2.5 p-2 bg-slate-200/30 rounded-lg dark:bg-slate-800/30 dark:border-neutral-700"
                            data-hs-input-number="">
                            <div class="w-full flex flex-wrap justify-between items-center md:space-x-3 space-y-3">
                                <div class="self-center">
                                    <div class="flex items-center space-x-2">
                                        <span class="block font-medium text-xs text-gray-400">
                                            Harga
                                        </span>
                                        <p
                                            class="font-normal text-xs line-through decoration-slate-400/60 dark:decoration-slate-200/40 text-slate-500 dark:text-slate-400">
                                            Rp . 3.500.000
                                            <x-badge color="success" label="2% OFF"
                                                class="bg-transparent dark:bg-transparent" />
                                        </p>
                                    </div>
                                    <span class="block text-sm text-gray-700 font-semibold dark:text-neutral-300"
                                        id="price-{{ $product->id }}">
                                        Rp {{ number_format($product->prices[0]->selling_price ?? 0, '0', '.', ',') }}
                                    </span>
                                </div>
                                <div class="flex flex-wrap items-center self-center  gap-x-1.5">
                                    <button type="button"
                                        class="descreasQty size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
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
                                        onclick="this.select();">
                                    <button type="button"
                                        class="increasQty size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
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
                <div class="col-span-12 flex flex-col items-center justify-center space-y-4 h-[calc(100vh-500px)] product-not-found">
                    <img src="{{ asset('assets/media/img/relax.png') }}" class="w-32 md:w-60 self-center"
                        alt="no product">
                    <p class="">Produk
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

    <script>
        function checkStock(productID, unitID, qtyAddtocart = 1, message = '') {
            //cek stok
            let qtyProductCart = parseInt($(`.row-cart-item-qty-${productID}${unitID}`).val() || 0);
            qtyProductCart += parseInt(qtyAddtocart);
            let stockProduct = $(`.row-stock-item${productID}`).text();
            if (parseInt(stockProduct) == 0 || parseInt(stockProduct) < parseInt(qtyProductCart)) {
                Toastify({
                    text: 'Stok tidak tersedia',
                    duration: 5000,
                    close: true,
                    gravity: "top", // `top` or `bottom`
                    position: "right", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        background: "#f59e0b",
                        borderRadius: "12px",
                        width: "300px"
                    },
                    onClick: function() {} // Callback after click
                }).showToast();

                return false;
            }

            return true;
        }
        

        $(document).ready(function() {
            $('.handle-unit').click(function() {
                let productID = $(this).data('product');
                let price = $(this).data('price');
                let unit = $(this).data('unit');
                let stok = $(this).data('qty');
                $(`#warehouseID`).val($(this).data('warehouse'));
                $(`.row-stock-item${productID}`).text(stok);

                $(`.handle-unit[data-product="${productID}"]`).removeClass("bg-primary-700/40").addClass(
                    "bg-slate-300/40 dark:bg-gray-800/40");
                $(this).removeClass("bg-slate-300/40 dark:bg-gray-800/40").addClass(
                    "bg-primary-700/30");

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
                let warehouse = $(`.warehouse${productID}`).val();
                let index = $(`.cart-item`).length;

                if (!checkStock(productID, unit, qty)) return;
                addToCart(productID, price, unit, qty)
            })

            $("#stopScan").on('click', function(e) {
                e.preventDefault()
                stopScan();
            })
        })
    </script>
  
