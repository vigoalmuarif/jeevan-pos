<form action="" id="handleProccessPayment">
    @csrf
    <div class="">
        <div class="flex flex-col space-y-2 cart-header mb-2" style="display: none;">
            {{-- @if (count($carts) > 0) --}}
            <div class="flex justify-between px-2.5">
                <p>Produk</p>
                <button type="button" class="text-rose-500 hover:text-rose-500/80 text-sm me-4"
                    onclick="clearCart()">Hapus
                    Semua</button>
            </div>
            {{-- @endif --}}
        </div>
        <input type="hidden" name="subtotal" id="subtotal" value="0">
        <input type="hidden" name="tax" id="tax" value="0">
        <input type="hidden" name="total" class="total" id="total" value="0">
        <input type="hidden" name="paymentTotal" id="paymentTotal">
        <input type="hidden" name="nominalBayar" id="nominalBayar">
        <input type="hidden" name="paymentKembalian" id="paymentKembalian">
        <div>
            <div
                class="h-[calc(100vh-525px)] product-cart-container overflow-y-auto scrollbar-thin flex flex-col space-y-2  px-2 cartItems">
                <div class="flex flex-col items-center justify-center space-y-4 h-[calc(100vh-480px)] empty-cart">
                    <img src="{{ asset('assets/media/img/add-to-cart.png') }}" class="w-20 sm:w-28 md:w-40"
                        alt="no product">
                    <p class="">Keranjang masih kosong
                    </p>
                </div>
            </div>

            <div class="absolute inset-x-0 bottom-0 pb-3 w-full px-2.5">
                <div
                    class="flex flex-col flex-nowrap px-2.5 bg-slate-200/60 rounded-lg dark:bg-slate-900/60 my-3 divide-y divide-slate-200/80 dark:divide-slate-700/40">
                    <div class="flex justify-between py-2.5">
                        <p class="text-base">Subtotal</p>
                        <p class="text-base font-semibold text-slate-700 dark:text-slate-200 mr-2.5 summary-subtotal">Rp
                            0,00</p>
                    </div>
                    <div class="flex justify-between items-center py-2.5">
                        <p class="text-base">Discount</p>
                        <input
                            class="formInput text-base bg-slate-50 dark:bg-slate-700 text-slate-700 dark:text-slate-200 font-medium w-32 text-right py-1.5"
                            id="summaryDiscount" type="text" name="discount_transaction" value="{{ $discount ?? 0 }}"
                            autocomplete="off" />
                    </div>
                    <div class="flex justify-between py-2.5">
                        <p class="text-base">Tax</p>
                        <p class="text-base font-semibold text-slate-700 dark:text-slate-200 mr-2.5 summary-tax"
                            data-tax="{{ $tax ?? 0 }}">Rp
                            {{ number_format($tax ?? 0, 2, ',', '.') }}</p>
                    </div>
                    <div class="flex justify-between py-2.5">
                        <p class="text-lg font-semibold text-primary-600">Total</p>
                        <p class="text-lg font-semibold text-primary-600 mr-2.5 transactionTotal  summary-total"
                            id="transactionTotal">Rp 0,00</p>
                    </div>
                </div>
                <div class="flex pb-2.5">
                    <x-form.label class="sr-only">voucher</x-form.label>
                    <input id="voucher" name="voucher" class="w-full formInput" placeholder="Voucher / Kupon"
                        autocomplete="off" />
                    <button type="button" id="checkVoucher" class="btnPrimary ms-2">Cek</button>
                    {{-- <x-form.label class="sr-only">method pay</x-form.label>
                    <x-form.select id="paymentMethod" name="paymentMethod" class="w-full" value=""
                        onchange="payMethod()">
                        <option value="tunai">Tunai</option>
                        <option value="trasfer">Transfer</option>
                    </x-form.select> --}}
                </div>
                <button type="button" class="btnPrimary h-full w-full py-3 text-lg proccess-pembayaran"
                    aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-static-backdrop-modal"
                    data-hs-overlay="#hs-static-backdrop-modal" disabled>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                    </svg>
                    Proses Pembayaran
                </button>
            </div>

        </div>

        @include('dashboard.transaction.cashier.carts.payment')
    </div>
</form>
@push('body-scripts')
    <script>
        var rupiah = (number) => {
            return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR"
            }).format(number);
        }

        var summaryDiscount = new AutoNumeric('#summaryDiscount', {
            currencySymbol: "Rp ",
            unformatOnSubmit: true
        })

        function clearCart() {
            Swal.fire({
                title: "Kosongkan keranjang?",
                text: `Semua produk akan dihapus dari keranjang.`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#9ca3af",
                cancelButtonColor: "#9333ea",
                confirmButtonText: "Kosongkan",
                cancelButtonText: "Tidak",
            }).then((result) => {
                if (result.isConfirmed) {
                    $('.cart-item').remove();
                    checkCart();
                    productSummary();
                    Toastify({
                        text: 'Produk berhasil dihapus dari keranjang!',
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

                }
            });

        }

        function checkCart() {
            if ($('.cart-item').length > 0) {
                $('.cart-header').show();
                $('.cart-item').show();
                $('.empty-cart').hide();
                $('.proccess-pembayaran').prop('disabled', false);
            } else {
                $('.proccess-pembayaran').prop('disabled', true);
                $('.cart-header').hide();
                $('.cart-item').hide();
                $('.empty-cart').show();
            }
            if ($('.warning-stock:visible').length > 0) {
                $('.proccess-pembayaran').prop('disabled', true);
            }

        }

        function productSummary() {
            let subtotal = 0;

            $('.cart-item').each(function() {
                let qty = parseInt($(this).find('.cart-item-qty').val()) || 0;
                let price = parseFloat($(this).find('.cart-item-price').data('price')) || 0;
                subtotal += qty * price;
            });
            $('.summary-subtotal').text(rupiah(subtotal));

            let tax = $('.summary-tax').data('tax');
            let total = parseFloat(subtotal) - (parseFloat(summaryDiscount.getNumber() + tax))
            $('.summary-total').text(rupiah(total));
            $('#subtotal').val(subtotal);
            $('#total').val(total);
            $('#paymentTotal').val(total);

        }

        function removeCartItem(productID = null, unitID = null) {
            let cartItem = productID + '-' + unitID;
            let productName = $(`#removeCartItem${productID}${unitID}`).data('product-name');
            let productUnit = $(`#removeCartItem${productID}${unitID}`).data('product-unit');
            let productQty = $(`#cartItemQty${productID}${unitID}`).val();

            Swal.fire({
                title: "Hapus produk dari keranjang?",
                text: `${productName} - ${productQty} ${productUnit}`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#9ca3af",
                cancelButtonColor: "#9333ea",
                confirmButtonText: "Hapus",
                cancelButtonText: "Tidak",
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`.cart-item[data-product-unit="${cartItem}"]`).fadeOut(300, function() {
                        $(this).remove();
                        checkCart();
                        productSummary();
                    });
                    Toastify({
                        text: 'Produk berhasil dihapus dari keranjang!',
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

                }
            });

        }

      
        $('.cart-item-descreas-qty').on('click', function(e) {
            e.preventDefault();
            let item = $(this).data('key');
            let cartItemQty = $(`.row-cart-item-qty-${item}`).val() || 1;
            let qty = parseInt(cartItemQty) - 1;
            $(`.row-cart-item-qty-${item}`).val() <= 1 ? $(`.row-cart-item-qty-${item}`).val(1) : $(
                `.row-cart-item-qty-${item}`).val(qty);
            productSummary()
        })
        $('.cart-item-increas-qty').on('click', function(e) {
            e.preventDefault();
            var item = $(this).data('key');
            var cartItemQty = $(`.row-cart-item-qty-${item}`).val();
            console.log(item);
            let qty = parseInt(cartItemQty) + 1;
            $(`.row-cart-item-qty-${item}`).val(qty);
            productSummary()
        })

        let TimerCheckStock;

        function qtyCart(type = null, item = null, product = null, warehouse = null, unit = null) {
            clearTimeout(TimerCheckStock);
            if (type == 'increas') {
                let cartItemQty = $(`.row-cart-item-qty-${item}`).val();
                let qty = parseInt(cartItemQty) + 1;
                $(`.row-cart-item-qty-${item}`).val(qty);
                productSummary();

                TimerCheckStock = setTimeout(() => {
                    checkAlokasiStok(qty, product, warehouse, unit)
                }, 500);
            } else {
                let cartItemQty = $(`.row-cart-item-qty-${item}`).val() || 1;
                let qty = parseInt(cartItemQty) - 1;
                $(`.row-cart-item-qty-${item}`).val() <= 1 ? $(`.row-cart-item-qty-${item}`).val(1) : $(
                    `.row-cart-item-qty-${item}`).val(qty);
                productSummary();

                TimerCheckStock = setTimeout(() => {
                    checkAlokasiStok(qty, product, warehouse, unit)
                }, 500);
            }
        }

        function editCartQty(item = null, product = null, warehouse = null, unit = null) {
            let qty = $(`#cartItemQty${item}`).val();
            qty = (qty == '' || qty == 0 ? '' : qty);
            $(`#cartItemQty${item}`).val(qty);
            productSummary()

            clearTimeout(TimerCheckStock);
            TimerCheckStock = setTimeout(() => {
                checkAlokasiStok(qty, product, warehouse, unit)
            }, 500);
        }

        function cegahQtyKosong(item = null, product = null, warehouse = null, unit = null) {
            let qty = $(`#cartItemQty${item}`).val();
            qty = (qty == '' || qty == 0 ? 1 : qty);
            $(`#cartItemQty${item}`).val(qty);
            productSummary()

            clearTimeout(TimerCheckStock);
            TimerCheckStock = setTimeout(() => {
                checkAlokasiStok(qty, product, warehouse, unit)
            }, 500);
        }

        function checkAlokasiStok(qty = 0, product = null, warehouse = null, unit = null) {
            $.ajax({
                type: "get",
                url: "{{ route('dashboards.cashier.check_stock') }}",
                data: {
                    qty: qty,
                    productID: product,
                    warehouseID: warehouse,
                    unitID: unit
                },
                success: function(response) {
                    if (response.status === false) {
                        $(`.row-warning-stock-${product}${unit}`).show()
                        Toastify({
                            text: response.message,
                            duration: 5000,
                            close: true,
                            gravity: "top", // `top` or `bottom`
                            position: "right", // `left`, `center` or `right`
                            stopOnFocus: true, // Prevents dismissing of toast on hover
                            style: {
                                background: "oklch(0.586 0.253 17.585)",
                                borderRadius: "12px",
                            },
                            onClick: function() {} // Callback after click
                        }).showToast();

                    } else {
                        $(`.row-warning-stock-${product}${unit}`).hide()
                    }

                    if ($('.warning-stock:visible').length > 0) {
                        $('.proccess-pembayaran').prop('disabled', true)
                    } else {
                        $('.proccess-pembayaran').prop('disabled', false)
                    }
                }
            })
        }

        $(document).ready(function() {
            checkCart();


            $('#summaryDiscount').on('keyup', function(e) {
                e.preventDefault();
                productSummary();
            })

            // $('.cart-item-qty').on('change', function(e) {
            //     e.preventDefault();
            //     checkPembayaran()
            // })

            $('#voucher').on('input', function() {
                $(this).val($(this).val().toUpperCase());
            });

            $('#checkVoucher').on('click', function(e) {
                e.preventDefault();
                Toastify({
                    text: 'Voucher belum tersedia',
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
            })

        })
    </script>
@endpush
