<div class="h-[calc(100vh-500px)] overflow-y-auto scrollbar-thin  px-2.5">
    <div class="flex flex-col space-y-2">
        @if (count($carts) > 0)
            <div class="flex justify-between px-2">
                <p>Produk</p>
                <button class="text-rose-500 hover:text-rose-500/80 text-sm" wire:click="deleteAll()" wire:loading.attr="disabled">Hapus Semua</button>
            </div>
        @endif
        @forelse ($carts as $index => $cart)
            <div class="bg-white border border-transparent hover:border-primary-400 rounded-xl shadow-2xs flex  dark:bg-neutral-900  dark:shadow-neutral-700/70"
                wire:key="cart-{{ $index }}">
                <div class="shrink-0 self-center h-20 w-20 mx-1.5">
                    <img class="w-20 h-20 rounded-xl object-cover"
                        src="{{ asset('storage/images/products/' . $cart['product']['profile_product_filename']) }}"
                        alt="Card Image">
                </div>
                <div class="p-2 w-full">
                    <p class="font-semibold text-slate-700 dark:text-slate-200">
                        {{ str()->of($cart['product']['name'])->limit(30) }}</p>
                    <x-badge color="primary" label="{{ $cart['satuan']['name'] }}"
                        class="cursor-pointer hover:text-primary-500" />
                    {{-- <p class="font-medium text-slate-600 dark:text-slate-300 pt-4">Rp . 3.500.000</p> --}}
                    <!-- Input Number -->
                    <div class="pt-2 bg-slate-200/60 rounded-lg dark:bg-neutral-900 dark:border-neutral-700"
                        data-hs-input-number="">
                        <div class="w-full flex flex-wrap justify-between items-center space-y-2">
                            <div>
                                <span class="block font-medium text-xs text-gray-400">
                                    Harga
                                </span>
                                <span class="block text-sm text-gray-700 dark:text-neutral-300">
                                    Rp {{ number_format($cart['price'], '0', '.', ',') }}
                                </span>
                            </div>
                            <div class="flex items-center self-end gap-x-1.5">
                                <button type="button"
                                    class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                                    tabindex="-1" aria-label="Decrease" data-hs-input-number-decrement="">
                                    <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14"></path>
                                    </svg>
                                </button>
                                <input
                                    class="p-0 w-10 bg-transparent border-0 text-sm text-gray-800 text-center focus:ring-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none dark:text-white"
                                    style="-moz-appearance: textfield;" type="number"
                                    aria-roledescription="Number field" data-hs-input-number-input=""
                                    :max="10000" wire:model.live="carts.{{ $index }}.qty">
                                <button type="button"
                                    class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                                    tabindex="-1" aria-label="Increase" data-hs-input-number-increment="">
                                    <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14"></path>
                                        <path d="M12 5v14"></path>
                                    </svg>
                                </button>
                                <button type="button" title="Hapus"
                                    class="size-6 inline-flex justify-center items-center ms-2 p-1 rounded-full text-sm font-medium bg-white text-gray-800 shadow-2xs bg-rose-800/30 hover:bg-rose-700/30 focus:outline-hidden focus:bg-rose-700/30 disabled:opacity-50 disabled:pointer-events-none dark:bg-rose-800/30  dark:text-white dark:hover:bg-bg-800/20 dark:focus:bg-rose-800/40"
                                    wire:click="delete({{ $index }})" wire:loading.attr="disabled"
                                    wire:target="delete({{ $index }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-20 h-20 stroke-rose-500">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>

                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- End Input Number -->
                </div>
            </div>
        @empty
        <div class="flex flex-col items-center justify-center space-y-4 h-[calc(100vh-500px)]">
            <img src="{{ asset('assets/media/img/add-to-cart.png') }}" class="w-32 md:w-60" alt="no product">
            <p class="absolute inset-x-0 top-1/2 transform -translate-y-1/2 text-center align-middle">Keranjang masih kosong</p>
        </div>
        @endforelse
    </div>
    <div class="absolute inset-x-0 bottom-0  w-full p-2">
        <div class="flex flex-col flex-nowrap px-2.5 bg-slate-300/60 rounded-lg dark:bg-slate-900/60 py-3 my-3 divide-y divide-slate-200/80 dark:divide-slate-700/40">
            <div class="flex justify-between py-2.5">
                <p class="text-base">Subtotal</p>
                <p  class="text-base font-semibold text-slate-700 dark:text-slate-200">Rp. {{ number_format($subtotal, 2, ',', '.') }}</p>
            </div>
            <div class="flex justify-between items-center py-2.5">
                <p class="text-base">Discount</p>
                <input class="formInput w-32 text-right py-1.5" id="discountTransacation" type="text" wire:model.live.blur="discountTransaction" />
            </div>
            <div class="flex justify-between py-2.5">
                <p class="text-base">Tax</p>
                <p class="text-base font-semibold text-slate-700 dark:text-slate-200">Rp. {{ number_format($tax, 2, ',', '.') }}</p>
            </div>
            <div class="flex justify-between py-2.5">
                <p class="text-lg font-semibold text-primary-600">Total</p>
                <p class="text-lg font-semibold text-primary-600">Rp. {{ number_format($total, 2, ',', '.') }}</p>
            </div>
        </div>
        <x-button type="button" class="btnPrimary h-full w-full py-3 text-lg" :disabled="count($carts) == 0"
            wire:click="proccessPayment()" wire:target="proccessPayment()">
            <x-slot:loading wire:target="proccessPayment()">
                Memproses...
            </x-slot:loading>
            <x-slot:default wire:target="proccessPayment()">
                Proses Pembayaran
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                </svg>

            </x-slot:default>
        </x-button>
    </div>

</div>
@push('body-scripts')
    <script>
        $(document).ready(function() {
            var discountTransacation = new AutoNumeric('#discountTransacation', {
                currencySymbol: "Rp ",
            })

        })
    </script>
@endpush