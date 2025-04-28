<div class="bg-white border border-transparent hover:border-primary-400 rounded-xl shadow-2xs flex  dark:bg-neutral-900  dark:shadow-neutral-700/70 cart-item"
data-product-unit="{{ $data['product']['id'] . '-' . $data['price']['unit']['id'] }}">
<input type="hidden" name="item[{{ $data['index'] }}][product]" value="{{ $data['product']['id'] }}">
<input type="hidden" name="item[{{ $data['index'] }}][price]" value="{{ $data['price']['selling_price'] }}">
<input type="hidden" name="item[{{ $data['index'] }}][discount_item]" value="0">
<input type="hidden" name="item[{{ $data['index'] }}][unit_id]" value="{{ $data['price']['unit']['id'] }}">
<input type="hidden" name="item[{{ $data['index'] }}][warehouse_id]" value="{{ $data['price']['warehouse_id'] }}">
<input type="hidden" name="item[{{ $data['index'] }}][cost_price]" value="{{ $data['price']['cost_price'] }}">
<input type="hidden" name="item[{{ $data['index'] }}][business_id]" value="{{ $data['product']['business_id'] }}">
        <div class="shrink-0 self-center h-20 w-20 mx-1.5">
            <img class="w-20 h-20 rounded-xl object-cover"
                src="{{ asset('storage/images/products/' . $data['product']['profile_product_filename']) }}"
                alt="Card Image">
        </div>
        <div class="p-2 w-full">
            <p class="font-semibold text-slate-700 dark:text-slate-200">
                {{ str()->of($data['product']['name'])->limit(30) }}</p>
            <x-badge color="primary" label="{{ $data['price']['unit']['name'] }}"
                class="cursor-pointer hover:text-primary-500 cart-item-unit"
                data-unit="{{ $data['price']['unit']['id'] }}" />
            {{-- <p class="font-medium text-slate-600 dark:text-slate-300 pt-4">Rp . 3.500.000</p> --}}
            <!-- Input Number -->
            <div class="p-1.5 mt-2 bg-slate-200/30 rounded-lg dark:bg-slate-900 dark:border-neutral-700"
                data-hs-input-number="">
                <div class="w-full flex flex-wrap justify-between items-center space-y-2">
                    <div>
                        <span class="block font-medium text-xs text-gray-400">
                            Harga
                        </span>
                        <span class="block text-sm text-gray-700 dark:text-neutral-300 cart-item-price"
                            data-price="{{ $data['price']['selling_price'] ?? 0 }}">
                            Rp {{ number_format($data['price']['selling_price'], '0', '.', ',') }}
                        </span>
                    </div>
                    <div class="flex items-center self-end gap-x-1.5">
                        <div class="warning-stock row-warning-stock-{{ $data['product']['id'] . $data['price']['unit']['id'] }}" style="display: none;" title="Qty tidak mencukupi">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 fill-rose-600">
                                <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                              </svg>
                        </div>
                        <button type="button"
                            class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800 cart-item-descreas-qty" data-key="{{ $data['product']['id'] . $data['price']['unit']['id'] }}" onclick="qtyCart('descreas', '{{ $data['product']['id'] . $data['price']['unit']['id'] }}', '{{ $data['product']['id'] }}', '{{ $data['price']['warehouse_id'] }}', '{{ $data['price']['product_unit_id'] }}')">
                            <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                            </svg>
                        </button>
                        <input
                            class="p-0 w-10 bg-transparent border-0 text-sm text-gray-800 text-center focus:ring-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none dark:text-white cart-item-qty row-cart-item-qty-{{ $data['product']['id'] . $data['price']['unit']['id'] }}" data-item="{{ $data['product']['id'] . $data['price']['unit']['id'] }}"
                            style="-moz-appearance: textfield;" type="number" name="item[{{ $data['index'] }}][qty]"  :max="10000" :min="1"
                            id="cartItemQty{{ $data['product']['id'] . $data['price']['unit']['id'] }}"
                            value="{{ number_format($data['qty'], '0', '.', ',') }}" onclick="this.select()" onkeyup="editCartQty('{{ $data['product']['id'] . $data['price']['unit']['id'] }}', '{{ $data['product']['id'] }}', '{{ $data['price']['warehouse_id'] }}', '{{ $data['price']['product_unit_id'] }}')" onchange="cegahQtyKosong('{{ $data['product']['id'] . $data['price']['unit']['id'] }}', '{{ $data['product']['id'] }}', '{{ $data['price']['warehouse_id'] }}', '{{ $data['price']['product_unit_id'] }}')">
                        <button type="button"
                            class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800 cart-item-increas-qty" data-key="{{ $data['product']['id'] . $data['price']['unit']['id'] }}" onclick="qtyCart('increas', '{{ $data['product']['id'] . $data['price']['unit']['id'] }}', '{{ $data['product']['id'] }}', '{{ $data['price']['warehouse_id'] }}', '{{ $data['price']['product_unit_id'] }}')">
                            <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                                <path d="M12 5v14"></path>
                            </svg>
                        </button>
                     
                        <button type="button" title="Hapus"
                            class="size-6 inline-flex justify-center items-center ms-2 p-1 rounded-full text-sm font-medium bg-white text-gray-800 shadow-2xs bg-rose-800/30 hover:bg-rose-700/30 focus:outline-hidden focus:bg-rose-700/30 disabled:opacity-50 disabled:pointer-events-none dark:bg-rose-800/30  dark:text-white dark:hover:bg-bg-800/20 dark:focus:bg-rose-800/40"
                            onclick="removeCartItem({{ $data['product']['id'] }}, {{ $data['price']['unit']['id'] }})"
                            id="removeCartItem{{ $data['product']['id'] . $data['price']['unit']['id'] }}"
                            data-product-name="{{ $data['product']['name'] }}"
                            data-product-unit="{{ $data['price']['unit']['name'] }}" data-qty="{{ $data['qty'] }}">
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


<script>
    $(document).ready(function(){
        // checkAlokasiStok('{{ $data['qty'] }}', '{{ $data['product']['id'] }}', '{{ $data['price']['warehouse_id'] }}', '{{ $data['price']['product_unit_id'] }}')
    })
        // window.HSStaticMethods.autoInit();
        // $(document).ready(function(){
          
        // })

</script>




    {{-- <script>
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
</script> --}}
