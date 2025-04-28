@php
    $subtotal = 0;
@endphp
@forelse ($carts as $index => $cart)
    @php
        $subtotal += $cart->price->selling_price * $cart->qty;
    @endphp
    <div class="bg-white border border-transparent hover:border-primary-400 rounded-xl shadow-2xs flex  dark:bg-neutral-900  dark:shadow-neutral-700/70"
        wire:key="cart-{{ $index }}">
        <div class="shrink-0 self-center h-20 w-20 mx-1.5">
            <img class="w-20 h-20 rounded-xl object-cover"
                src="{{ asset('storage/images/products/' . $cart->product->profile_product_filename) }}" alt="Card Image">
        </div>
        <div class="p-2 w-full">
            <p class="font-semibold text-slate-700 dark:text-slate-200">
                {{ str()->of($cart['product']['name'])->limit(30) }}</p>
            <x-badge color="primary" label="{{ $cart->unit->name }}" class="cursor-pointer hover:text-primary-500" />
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
                            Rp {{ number_format($cart->price->selling_price, '0', '.', ',') }}
                        </span>
                    </div>
                    <div class="flex items-center self-end gap-x-1.5">
                        <button type="button"
                            class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                            tabindex="-1" aria-label="Decrease" data-hs-input-number-decrement="">
                            <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                            </svg>
                        </button>
                        <input
                            class="p-0 w-10 bg-transparent border-0 text-sm text-gray-800 text-center focus:ring-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none dark:text-white"
                            style="-moz-appearance: textfield;" type="number" aria-roledescription="Number field"
                            data-hs-input-number-input="" :max="10000"
                            value="{{ number_format($cart->qty, '0', '.', ',') }}">
                        <button type="button"
                            class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                            tabindex="-1" aria-label="Increase" data-hs-input-number-increment="">
                            <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                                <path d="M12 5v14"></path>
                            </svg>
                        </button>
                        <button type="button" title="Hapus"
                            class="size-6 inline-flex justify-center items-center ms-2 p-1 rounded-full text-sm font-medium bg-white text-gray-800 shadow-2xs bg-rose-800/30 hover:bg-rose-700/30 focus:outline-hidden focus:bg-rose-700/30 disabled:opacity-50 disabled:pointer-events-none dark:bg-rose-800/30  dark:text-white dark:hover:bg-bg-800/20 dark:focus:bg-rose-800/40"
                            onclick="deleteItemCart({{ $cart->id }})" id="deleteItemCart{{ $cart->id }}">
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
    <div class="flex flex-col items-center justify-center space-y-4 h-[calc(100vh-600px)]">
        <img src="{{ asset('assets/media/img/add-to-cart.png') }}" class="w-32 md:w-60" alt="no product">
        <p class="absolute inset-x-0 top-1/2 transform -translate-y-1/2 text-center align-middle">Keranjang masih kosong
        </p>
    </div>
@endforelse
<div class="absolute inset-x-0 bottom-0  w-full p-2">
    <div class="grid grid-cols-4 gap-2 py-1">
        <button type="button"
            class="p-2 rounded-xl text-primary-600 dark:text-primary-300 hover:bg-primary-600 hover:text-white inline-flex items-center justify-center bg-primary-800/30 text-base font-semibold h-14"
            onClick="addNumber(1)">
            Cash
        </button>
        <button type="button"
            class="p-2 rounded-xl text-primary-600 dark:text-primary-300 hover:bg-primary-600 hover:text-white inline-flex items-center justify-center bg-primary-800/30 text-base font-semibold h-14"
            onClick="addNumber(2)">
            QrCode
        </button>
        <button type="button"
            class="p-2 rounded-xl text-primary-600 dark:text-primary-300 hover:bg-primary-600 hover:text-white inline-flex items-center justify-center bg-primary-800/30 text-base font-semibold h-14"
            onClick="addNumber(3)">
            E-Wallet
        </button>
        <button type="button"
            class="p-2 rounded-xl text-primary-600 dark:text-primary-300 hover:bg-primary-600 hover:text-white inline-flex items-center justify-center bg-primary-800/30 text-base font-semibold h-14"
            onClick="addNumber(3)">
            Gabungan
        </button>
    </div>
    <div
        class="flex flex-col flex-nowrap px-2.5 bg-slate-300/60 rounded-lg dark:bg-slate-900/60 my-3 divide-y divide-slate-200/80 dark:divide-slate-700/40">
        <div class="flex justify-between py-2.5">
            <p class="text-base">Subtotal</p>
            <p class="text-base font-semibold text-slate-700 dark:text-slate-200 mr-2.5">Rp
                {{ number_format($subtotal, 2, ',', '.') }}</p>
        </div>
        <div class="flex justify-between items-center py-2.5">
            <p class="text-base">Discount</p>
            <input class="formInput text-base text-slate-700 dark:text-slate-200 font-medium w-32 text-right py-1.5"
                id="discountTransacation" type="text" value="{{ $discount }}" autocomplete="off" />
        </div>
        <div class="flex justify-between py-2.5">
            <p class="text-base">Tax</p>
            <p class="text-base font-semibold text-slate-700 dark:text-slate-200 mr-2.5">Rp
                {{ number_format($tax ?? 0, 2, ',', '.') }}</p>
        </div>
        <div class="flex justify-between py-2.5">
            <p class="text-lg font-semibold text-primary-600">Total</p>
            <p class="text-lg font-semibold text-primary-600 mr-2.5 transactionTotal" id="transactionTotal"></p>
        </div>
    </div>
    <input type="hidden" name="subtotal" id="subtotal" value="{{ $subtotal }}">
    <input type="hidden" name="tax" id="tax" value="{{ $tax }}">
    <input type="hidden" name="total" class="total" id="total" value="0">
    <button type="button" class="btnPrimary h-full w-full py-3 text-lg" aria-haspopup="dialog"
        aria-expanded="false" aria-controls="hs-static-backdrop-modal" data-hs-overlay="#hs-static-backdrop-modal">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
        </svg>
        Proses Pembayaran
    </button>
</div>


<div id="hs-static-backdrop-modal"
    class="hs-overlay [--overlay-backdrop:static] hidden size-full fixed top-0 start-0 z-[1000] overflow-x-hidden overflow-y-auto pointer-events-none"
    role="dialog" tabindex="-1" aria-labelledby="hs-static-backdrop-modal-label" data-hs-overlay-keyboard="false">
    <div
        class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-xl sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
        <div
            class="flex flex-col bg-white border w-full border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                <h6 id="hs-static-backdrop-modal-label" class="font-bold text-gray-800 dark:text-white">
                    Pembayaran Tunai
                </h6>
                <button type="button"
                    class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                    aria-label="Close" data-hs-overlay="#hs-static-backdrop-modal">
                    <span class="sr-only">Close</span>
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>
            </div>
            <form action="">
                @csrf
                <input type="text" name="paymentTotal" id="paymentTotal">
                <input type="text" name="paymentKembalian" id="paymentKembalian">
                <div class="p-4 overflow-y-auto">
                    <div
                        class="flex flex-col flex-nowrap px-2.5 bg-slate-300/60 rounded-lg dark:bg-slate-900/30 my-1.5 divide-y divide-slate-200/80 dark:divide-slate-700/40">
                        <div class="flex justify-between py-2.5">
                            <p class="text-lg font-semibold text-primary-600">Total</p>
                            <p class="text-lg font-semibold text-primary-600 mr-2.5 transactionTotal"></p>
                        </div>
                    </div>
                    <div class="my-5">
                        <p class="mt-1 text-gray-600 dark:text-neutral-400 text-base">
                            Bayar
                        </p>
                        <p class="mt-1 text-gray-400 dark:text-neutral-500 text-5xl font-extrabold">
                            Rp <span class="text-gray-800 dark:text-neutral-200" id="payment"></span>
                        </p>
                    </div>
                    <div
                        class="flex flex-col flex-nowrap px-2.5 bg-slate-300/60 rounded-lg dark:bg-slate-900/30 my-1.5 divide-y divide-slate-200/80 dark:divide-slate-700/40">
                        <div class="flex justify-between py-2.5">
                            <p class="text-lg font-semibold text-green-600">Kembalian</p>
                            <p class="text-lg font-semibold text-green-600 mr-2.5 kembalian">0</p>
                        </div>
                    </div>

                    <div class="flex flex-wrap justify-between items-center py-3">
                        <button type="button"
                            class="rounded-full text-green-600 dark:text-green-300 hover:bg-green-600 hover:text-white inline-flex items-center justify-center bg-green-800/30 text-sm font-medium py-2 px-4"
                            onClick="addNumber(1)">
                            Uang Pas
                        </button>
                        <button type="button"
                            class="rounded-full text-green-600 dark:text-green-300 hover:bg-green-600 hover:text-white inline-flex items-center justify-center bg-green-800/30 text-sm font-medium py-2 px-4"
                            onClick="addNumber(1)">
                            50.000
                        </button>
                        <button type="button"
                            class="rounded-full text-green-600 dark:text-green-300 hover:bg-green-600 hover:text-white inline-flex items-center justify-center bg-green-800/30 text-sm font-medium py-2 px-4"
                            onClick="addNumber(1)">
                            100.000
                        </button>
                        <button type="button"
                            class="rounded-full text-green-600 dark:text-green-300 hover:bg-green-600 hover:text-white inline-flex items-center justify-center bg-green-800/30 text-sm font-medium py-2 px-4"
                            onClick="addNumber(1)">
                            200.000
                        </button>
                        <button type="button"
                            class="rounded-full text-green-600 dark:text-green-300 hover:bg-green-600 hover:text-white inline-flex items-center justify-center bg-green-800/30 text-sm font-medium py-2 px-4"
                            onClick="addNumber(1)">
                            500.000
                        </button>
                    </div>
                    <div class="grid grid-cols-3 gap-2 py-1">
                        <button type="button"
                            class="rounded-xl text-primary-600 dark:text-primary-300 hover:bg-primary-600 hover:text-white inline-flex items-center justify-center bg-primary-800/30 text-3xl font-extrabold h-20"
                            onClick="addNumber(1)">
                            1
                        </button>
                        <button type="button"
                            class="rounded-xl text-primary-600 dark:text-primary-300 hover:bg-primary-600 hover:text-white inline-flex items-center justify-center bg-primary-800/30 text-3xl font-extrabold h-20"
                            onClick="addNumber(2)">
                            2
                        </button>
                        <button type="button"
                            class="rounded-xl text-primary-600 dark:text-primary-300 hover:bg-primary-600 hover:text-white inline-flex items-center justify-center bg-primary-800/30 text-3xl font-extrabold h-20"
                            onClick="addNumber(3)">
                            3
                        </button>
                    </div>
                    <div class="grid grid-cols-3 gap-2 py-1">
                        <button type="button"
                            class=" rounded-xl text-primary-600 dark:text-primary-300 hover:bg-primary-600 hover:text-white inline-flex items-center justify-center bg-primary-800/30 text-3xl font-extrabold h-20"
                            onClick="addNumber(4)">
                            4
                        </button>
                        <button type="button"
                            class="rounded-xl text-primary-600 dark:text-primary-300 hover:bg-primary-600 hover:text-white inline-flex items-center justify-center bg-primary-800/30 text-3xl font-extrabold h-20"
                            onClick="addNumber(5)">
                            5
                        </button>
                        <button type="button"
                            class="rounded-xl text-primary-600 dark:text-primary-300 hover:bg-primary-600 hover:text-white inline-flex items-center justify-center bg-primary-800/30 text-3xl font-extrabold h-20"
                            onClick="addNumber(6)">
                            6
                        </button>
                    </div>
                    <div class="grid grid-cols-3 gap-2 py-1">
                        <button type="button"
                            class="rounded-xl text-primary-600 dark:text-primary-300 hover:bg-primary-600 hover:text-white inline-flex items-center justify-center bg-primary-800/30 text-3xl font-extrabold h-20"
                            onClick="addNumber(7)">
                            7
                        </button>
                        <button type="button"
                            class="rounded-xl text-primary-600 dark:text-primary-300 hover:bg-primary-600 hover:text-white inline-flex items-center justify-center bg-primary-800/30 text-3xl font-extrabold h-20"
                            onClick="addNumber(8)">
                            8
                        </button>
                        <button type="button"
                            class="rounded-xl text-primary-600 dark:text-primary-300 hover:bg-primary-600 hover:text-white inline-flex items-center justify-center bg-primary-800/30 text-3xl font-extrabold h-20"
                            onClick="addNumber(9)">
                            9
                        </button>
                    </div>
                    <div class="grid grid-cols-3 gap-2 py-1">
                        <button type="button"
                            class="rounded-xl text-primary-600 dark:text-primary-300 hover:bg-primary-600 hover:text-white inline-flex items-center justify-center bg-primary-800/30 text-3xl font-extrabold h-20"
                            onClick="addNumber('000')">
                            000
                        </button>
                        <button type="button"
                            class="rounded-xl text-primary-600 dark:text-primary-300 hover:bg-primary-600 hover:text-white inline-flex items-center justify-center bg-primary-800/30 text-3xl font-extrabold h-20"
                            onClick="addNumber('00')">
                            00
                        </button>
                        <button type="button"
                            class="rounded-xl text-primary-600 dark:text-primary-300 hover:bg-primary-600 hover:text-white inline-flex items-center justify-center bg-primary-800/30 text-3xl font-extrabold h-20"
                            onClick="addNumber('0')">
                            0
                        </button>
                    </div>
                    <div class="grid grid-cols-3 gap-2 py-1">
                        <button type="button"
                            class="rounded-xl text-primary-600 dark:text-primary-300 hover:bg-primary-600 hover:text-white inline-flex items-center justify-center bg-primary-800/30 text-3xl font-extrabold h-20"
                            onClick="addNumber('c')">
                            C
                        </button>
                        <button type="button"
                            class="rounded-xl text-primary-600 dark:text-primary-300 hover:bg-primary-600 hover:text-white inline-flex items-center justify-center bg-primary-800/30 text-3xl font-extrabold h-20"
                            onClick="addNumber('enter')">
                            Enter
                        </button>
                        <button type="button"
                            class="rounded-xl text-primary-600 dark:text-primary-300 hover:bg-primary-600 hover:text-white inline-flex items-center justify-center bg-primary-800/30 text-3xl font-extrabold h-20"
                            onClick="addNumber('backspace')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9.75 14.25 12m0 0 2.25 2.25M14.25 12l2.25-2.25M14.25 12 12 14.25m-2.58 4.92-6.374-6.375a1.125 1.125 0 0 1 0-1.59L9.42 4.83c.21-.211.497-.33.795-.33H19.5a2.25 2.25 0 0 1 2.25 2.25v10.5a2.25 2.25 0 0 1-2.25 2.25h-9.284c-.298 0-.585-.119-.795-.33Z" />
                            </svg>
                        </button>

                    </div>
                </div>
            </form>
        </div>
        {{-- <div
                class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                <button type="button"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                    data-hs-overlay="#hs-static-backdrop-modal">
                    Close
                </button>
                <button type="button"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                    Save changes
                </button>
            </div> --}}
    </div>
</div>
</div>



<script>
    window.HSStaticMethods.autoInit();


    var rupiah = (number) => {
        return new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR"
        }).format(number);
    }

    function deleteItemCart(cartID = null) {
        if (cartID == null) {
            Toastify({
                text: 'Produk tidak ditemukan.',
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

            return false;
        }

        Swal.fire({
            title: "Hapus produk dari keranjang?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#9ca3af",
            cancelButtonColor: "#9333ea",
            confirmButtonText: "Hapus",
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route('dashboards.cashier.delete_item_cart') }}',
                    type: 'get',
                    data: {
                        cartID: cartID
                    },
                    beforeSend: function() {
                        $(`#deleteItemCart${cartID}`).prop('disabled', true);
                    },
                    success: function(response) {
                        if (response.status === false) {
                            $(`#deleteItemCart${cartID}`).prop('disabled', false);
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
                            return false;
                        }
                        getCarts();
                        setTimeout(() => {
                            Toastify({
                                text: response.message,
                                duration: 5000,
                                close: true,
                                gravity: "top", // `top` or `bottom`
                                position: "right", // `left`, `center` or `right`
                                stopOnFocus: true, // Prevents dismissing of toast on hover
                                style: {
                                    background: "#059669",
                                    borderRadius: "12px",
                                },
                                onClick: function() {} // Callback after click
                            }).showToast();

                        }, 1000);
                    }
                })
            }
        });
    }

    function parseFormattedNumber(formattedNumber) {
        let cleanNumber = formattedNumber.toString().replace(/\D/g, ''); // Hapus karakter selain angka
        let removeLeadingZero = cleanNumber.replace(/^0+/, ''); // hapus nol jika ada didepan
        return removeLeadingZero.replace(/\B(?=(\d{3})+(?!\d))/g, "."); //format ribuan
    }

    function addNumber(number) {
        if ((number == '0' || number == '00' || number == '000') && parseInt($('#payment').text()) < 1) {
            $('#payment').text('0');
            return;
        }
        if (number == 'c') {
            $('#payment').text('0');
            return;
        }
        if (number == 'backspace') {
            let payment = $('#payment').text().slice(0, -1);
            $('#payment').text(parseFormattedNumber(payment));
            if (payment.length == 0) {
                $('#payment').text(0);
                return;
            }
            return;
        }

        let payment = $('#payment').text();
        payment += number;
        $('#payment').text(parseFormattedNumber(payment));

        
        let total = $("#total").val();
        let pay =  $("#payment").text().replace(/\D/g, '');
        let kembalian = parseFloat(total - pay)
            $('#paymentKembalian').val(kembalian);
            $('.kembalian').text(parseFormattedNumber(kembalian));
    }

    $(document).ready(function() {
        function calculate() {
            let subtotal = '{{ $subtotal }}';
            let tax = $('#tax').val();
            let discount = discountTransacation.getNumber();
            let total = parseFloat(subtotal) - (parseFloat(discount) + parseFloat(tax));
            let totalFormatCurrency = rupiah(total);
            let transactionTotal = $('.transactionTotal').text(totalFormatCurrency);

            $('.total').val(total);
            $('#paymentTotal').val(total);

        }


        var discountTransacation = new AutoNumeric('#discountTransacation', {
            currencySymbol: "Rp ",
        })

        calculate();

        $('#discountTransacation').keyup(function(e) {
            e.preventDefault();
            calculate();
        })

        $('#payment').text(0);


    })
</script>
