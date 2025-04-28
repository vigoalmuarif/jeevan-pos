@extends('dashboard.transaction.cashier.layouts.index')

@section('title', 'Kasir')

@section('contents')
    <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-12 gap-x-4 pt-5">
        <x-card-basic class="w-full lg:col-span-9 shadow-none bg-transparent border-none p-5">
            <input type="hidden" name="category_selected" id="categorySelected">

            <div class="flex flex-wrap space-x-3 items-center justify-between px-1.5 w-full mb-3">
                <div class="flex space-x-3 items-center">
                    {{-- <div class="w-32 shrink-0">
                            <label for="transactionDate" class="sr-only">tgl transaksi</label>
                            <div class="relative">
                                <input type="text" id="transactionDate" name="transactionDate" class="ps-10 formInput"
                                    placeholder="Transaksi" autocomplete="off">
                                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                    </svg>
                                </div>
                            </div>
                    </div> --}}
                    <div class="grow w-80">
                        <label for="searchProduct"
                            class="block text-sm font-medium mb-2 dark:text-white sr-only">serach</label>
                        <div class="relative">
                            <input type="search" id="searchProduct" name="searchProduct"
                                class="py-2.5 sm:py-3 px-4 ps-11 block w-full border-gray-200 rounded-xl sm:text-sm focus:z-10 focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="Cari nama, sku produk atau scan..." oninput="searchProduct()"
                                autocomplete="off" value="12345" autofocus>
                            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                </svg>

                            </div>
                        </div>
                    </div>
                    <button type="button" id="startScan"
                        class="py-2.5 px-4 bg-slate-200 dark:bg-slate-800 rounded-xl hover:bg-primary-600/20" disabled title="Scan Produk">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-barcode inline-flex">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 7v-1a2 2 0 0 1 2 -2h2" />
                            <path d="M4 17v1a2 2 0 0 0 2 2h2" />
                            <path d="M16 4h2a2 2 0 0 1 2 2v1" />
                            <path d="M16 20h2a2 2 0 0 0 2 -2v-1" />
                            <path d="M5 11h1v2h-1z" />
                            <path d="M10 11l0 2" />
                            <path d="M14 11h1v2h-1z" />
                            <path d="M19 11l0 2" />
                        </svg>
                    </button>
                    <button type="button"
                        class="py-2.5 px-4 bg-slate-200 dark:bg-slate-800 rounded-xl hover:bg-primary-600/20"
                        title="Refresh" id="refreshProduct">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5 stroke-2 inline-flex">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                    </button>
                </div>
                <div class="flex space-x-3 items-center">
                    <div class="flex space-x-2 5 items-center">
                        <div class="p-2 rounded-full bg-primary-400/20">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5 stroke-primary-700">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                        </div>
                        <p class="today-day text-base font-medium"></p>
                    </div>
                    <div class="flex space-x-2 5 items-center">
                        <div class="p-2 rounded-full bg-primary-400/20">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5 stroke-primary-700">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <p class="today-time text-base font-medium"></p>
                    </div>
                </div>
                
            </div>
            {{-- <h6 class="pb-4">Daftar Kategori</h6> --}}
            <x-card-basic class="py-5 border-none rounded-2xl">
                @include('dashboard.transaction.cashier.products.category')
            </x-card-basic>
            <div class="">
                <div class="flex justify-between items-center">
                    <h6 class="pb-4">Daftar Produk</h6>
                </div>
            </div>
            <div class="products-container">
            </div>
            <div class="products-skeleton h-full">
                @include('dashboard.transaction.cashier.products.skeleton')
            </div>
        </x-card-basic>

        <x-card-basic class="w-full lg:col-span-3 border-none relative">
            <div class=" p-3 flex justify-between">
                <h6>Keranjang</h6>
                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 0 0-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 0 0-2.282.819l-.922 1.597a1.875 1.875 0 0 0 .432 2.385l.84.692c.095.078.17.229.154.43a7.598 7.598 0 0 0 0 1.139c.015.2-.059.352-.153.43l-.841.692a1.875 1.875 0 0 0-.432 2.385l.922 1.597a1.875 1.875 0 0 0 2.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 0 0 2.28-.819l.923-1.597a1.875 1.875 0 0 0-.432-2.385l-.84-.692c-.095-.078-.17-.229-.154-.43a7.614 7.614 0 0 0 0-1.139c-.016-.2.059-.352.153-.43l.84-.692c.708-.582.891-1.59.433-2.385l-.922-1.597a1.875 1.875 0 0 0-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 0 0-.985-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 0 0-1.85-1.567h-1.843ZM12 15.75a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z" clip-rule="evenodd" />
                      </svg>
                      
                </button>
            </div>
            <div class="carts-container">
                @include('dashboard.transaction.cashier.carts.index')
            </div>
            <div class="carts-skeleton">
                {{-- @include('dashboard.transaction.cashier.carts.skeleton') --}}
            </div>
        </x-card-basic>
    </div>

@endsection

@push('body-scripts')
    <script>
        function getProducts() {
            $('#startScan').prop('disabled', true);
            $.ajax({
                url: '{{ route('dashboards.cashier.products') }}',
                type: 'get',
                success: function(response) {
                    $('.products-skeleton').hide();
                    $('.products-container').html(response);
                    $('#startScan').prop('disabled', false);
                }
            })
        }

        let debounceTimer;

        function searchProduct(value = null, type = null) {
            clearTimeout(debounceTimer); // Hapus timer sebelumnya
            var item = $('#searchProduct').val().trim(); // Ambil key unik produk


            if (type === 'scan') {
                $.ajax({
                    url: '{{ route('dashboards.cashier.scan_product') }}',
                    type: 'get',
                    data: {
                        barcode: item
                    },
                    success: function(response) {
                        let price = response.data.selling_price || response.data.base_selling_price;
                        addToCart(response.data.productid, price, response.data.satuanid, 1)
                        $('#searchProduct').val('');
                        console.log(response)
                    }
                })
            } else {
                debounceTimer = setTimeout(() => {
                    stopScan();
                    $('.products-container').html('');
                    $('.products-skeleton').show();
                    $.ajax({
                        url: '{{ route('dashboards.cashier.products') }}',
                        type: 'get',
                        data: {
                            categoryID: $('#categorySelected').val(),
                            search: item
                        },
                        success: function(response) {
                            $('.products-skeleton').hide();
                            $('.products-container').html(response)
                        }
                    })
                }, 700); // Tunggu 500ms setelah terakhir mengetik
            }

        }

        function addToCart(productID, price, unit, qty) {
            let index = $(`.cart-item`).length;
            let cartItem = $(`.cart-item[data-product-unit="${productID}-${unit}"]`);
            if (cartItem.length > 0) {
                // Jika produk sudah ada, update qty
                let currentQty = parseInt(cartItem.find('.cart-item-qty').val());
                let newQty = currentQty + parseInt(qty);
                if (!checkStock(productID, unit, qty)) return;
                // checkAlokasiStok(newQty, productID, warehouse, unit)
                cartItem.find('.cart-item-qty').val(newQty);
                $(`.qty-${productID}`).val(1)
                productSummary();
                return;
            }
            $.ajax({
                url: '{{ route('dashboards.cashier.add_to_cart') }}',
                type: 'get',
                data: {
                    product: productID,
                    price: price,
                    unit: unit,
                    qty: qty,
                    index: index
                },
                beforeSend: function() {
                    $(`.handleAddToCart${productID}`).prop('disabled', true);
                },
                success: function(response) {
                    if (response?.status === false) {
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
                                width: "300px"
                            },
                            onClick: function() {} // Callback after click
                        }).showToast();

                        return;
                    }

                    $('.cartItems').append(response);
                    $(`.qty-${productID}`).val(1)
                    checkCart();
                    productSummary();
                    $('.cartItems').animate({
                        scrollTop: $('.cartItems')[0].scrollHeight
                    }, 500); // 500ms untuk efek smooth scroll

                },
                complete: function() {
                    $(`.handleAddToCart${productID}`).prop('disabled', false);
                },

            })
        }


        function getCarts() {
            $.ajax({
                url: '{{ route('dashboards.cashier.carts') }}',
                type: 'get',
                success: function(response) {
                    $('.carts-skeleton').hide();
                    $('.carts-container').html(response)
                }
            })
        }

        function selectedCategory(categoryID = null) {
            $('.products-container').html('');
            $('.products-skeleton').show();
            $('#categorySelected').val(categoryID);
            $('#startScan').prop('disabled', true);
            stopScan();
            let search = $('#searchProduct').val();
            if (categoryID === null) {
                $('.category').removeClass('bg-primary-700/70').addClass('bg-slate-200 dark:bg-slate-800');
                $('.category-title').removeClass('text-white').addClass('text-slate-700 dark:text-slate-200');
                $('.category-active-default').removeClass('bg-slate-200 dark:bg-slate-800').addClass('bg-primary-700/70');
                $('.category-active-title-default').removeClass('text-slate-700 dark:text-slate-200').addClass(
                    'text-white');
                $('.category-total').removeClass('text-slate-200').addClass('text-slate-500');
                $('.category-total-active-default').removeClass('text-slate-500').addClass('text-slate-200');
                $('.icon-category').removeClass('stroke-primary-500').addClass(
                    'group-hover:stroke-primary-500 stroke-slate-200');
                $(`#iconCategory`).removeClass('group-hover:stroke-primary-500 stroke-slate-200').addClass(
                    'stroke-primary-500');
            } else {
                $('.category').removeClass('bg-primary-700/70').addClass('bg-slate-200 dark:bg-slate-800');
                $('.category-title').removeClass('text-white').addClass('text-slate-700 dark:text-slate-200');
                $(`.category-title-active-${categoryID}`).removeClass('text-slate-700 dark:text-slate-200').addClass(
                    'text-white');
                $('.category-total').removeClass('text-slate-200').addClass('text-slate-500 dark:text-slate-400');
                $(`.category-total-active-${categoryID}`).removeClass('text-slate-500 dark:text-slate-400').addClass(
                    'text-slate-200');
                $(`.category${categoryID}`).removeClass('bg-slate-200 dark:bg-slate-800').addClass('bg-primary-700/70');
                $('.icon-category').removeClass('stroke-primary-500').addClass(
                    'group-hover:stroke-primary-500 stroke-slate-200');
                $(`#iconCategory${categoryID}`).removeClass('group-hover:stroke-primary-500 stroke-slate-200').addClass(
                    'stroke-primary-500');
            }
            $.ajax({
                url: '{{ route('dashboards.cashier.products') }}',
                type: 'get',
                data: {
                    categoryID: categoryID,
                    search: search
                },
                success: function(response) {
                    $('.products-skeleton').hide();
                    $('.products-container').html(response);
                    $('#startScan').prop('disabled', false);
                }
            })
        }

        let isScannerRunning = false;
        let isScanning = false;
        let html5QrCode;
        const beepSound = new Audio('/assets/media/sound/beep-23.mp3');

        function startScan() {

            if (!html5QrCode) {
                html5QrCode = new Html5Qrcode("reader");
            }

            $("#scannCamera").show();
            html5QrCode.start({
                    facingMode: "environment"
                }, // Kamera belakang
                {
                    fps: 10,
                    qrbox: {
                        width: 250,
                        height: 250
                    }, // Sesuaikan ukuran
                    disableFlip: false
                },
                (decodedText, decodedResult) => {
                    if (!isScanning) {
                        console.log("Scanned:", decodedText);
                        isScanning = true;
                        beepSound.play();
                        $('#searchProduct').val(decodedText).trigger($.Event('keypress', {
                            keyCode: 13
                        }));


                        // // Hentikan scanner setelah scan berhasil
                        // html5QrCode.stop().then(() => {
                        //     console.log("Scanner stopped");
                        // }).catch(err => {
                        //     console.log("Error stopping scanner:", err);
                        // });

                        // Jika ingin restart setelah beberapa detik, gunakan setTimeout
                        setTimeout(() => {
                            isScanning = false; // Reset flag untuk bisa scan lagi
                            // startScanner(); // Mulai ulang scanner jika diperlukan
                        }, 2500); // Restart scanner setelah 3 detik (bisa diubah sesuai kebutuhan)

                    }
                },
                (errorMessage) => {
                    console.log("Scanning error:", errorMessage);
                }
            ).then(() => {
                isScannerRunning = true;
                document.getElementById('startScan').disabled = true;
                document.getElementById('stopScan').disabled = false;
                $('.product-not-found').hide();
                console.log("Scanner is Running");
            }).catch(err => {
                console.log("Error starting scanner: ", err);
            });
        }

        function stopScan() {
            if (isScannerRunning) {
                html5QrCode.stop().then(() => {
                    isScannerRunning = false;
                    document.getElementById('startScan').disabled = false;
                    $('#stopScan').prop('disabled', true);
                    $('.product-not-found').show();
                    $("#scannCamera").hide();
                    console.log("Scanner is stoped.");
                });
            } else {
                console.log("Scanner is not running.");
            }
        }

        $(document).ready(function() {
            getProducts();

            var transactionDate = new Pikaday({
                field: $('#transactionDate')[0],
                format: 'YYYY-MM-DD',
                defaultDate: new Date(),
                setDefaultDate: true,
                toString(date, format) {
                    // you should do formatting based on the passed format,
                    // but we will just return 'D/M/YYYY' for simplicity
                    const day = date.getDate();
                    const month = date.getMonth() + 1;
                    const year = date.getFullYear();
                    return `${day}-${month}-${year}`;
                },
                parse(dateString, format) {
                    // dateString is the result of `toString` method
                    const parts = dateString.split('-');
                    const day = parseInt(parts[0], 10);
                    const month = parseInt(parts[1], 10) - 1;
                    const year = parseInt(parts[2], 10);
                    return new Date(year, month, day);
                }
            });
            $('#refreshProduct').on('click', function(e) {
                e.preventDefault();
                // stopScan();
                $('.products-container').html('');
                $('.products-skeleton').show();
                $('.cart-item').remove()
                $('input').val('');
                checkCart();
                getProducts();
                productSummary();
                selectedCategory();
            })


            $('#searchProduct').on('keypress', function(e) {
                if (e.keyCode === 13) {
                    e.preventDefault();
                    let barcode = $(this).val().trim();
                    if (barcode.length > 0) {
                        searchProduct(barcode, "scan");
                    }
                }
            })

            $("#startScan").on('click', function(e) {
                e.preventDefault()
                startScan();
            })

        })
    </script>
@endpush
