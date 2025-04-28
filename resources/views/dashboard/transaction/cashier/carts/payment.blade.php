<div id="hs-static-backdrop-modal"
    class="hs-overlay [--overlay-backdrop:static] hidden size-full fixed top-0 start-0 z-[1000] overflow-x-hidden overflow-y-auto pointer-events-none"
    role="dialog" tabindex="-1" aria-labelledby="hs-static-backdrop-modal-label" data-hs-overlay-keyboard="false">
    <div
        class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-xl sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
        <div
            class="flex flex-col bg-white border w-full border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                <h6 id="hs-static-backdrop-modal-label" class="font-bold text-gray-800 dark:text-white">
                    Proses Pembayaran
                </h6>
                <button type="button" id="closePayment"
                    class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                    aria-label="Close" data-hs-overlay="#hs-static-backdrop-modal">
                    <span class="sr-only">Close</span>
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="p-4 overflow-y-auto">
                <div
                    class="flex flex-col flex-nowrap px-2.5 bg-slate-300/60 rounded-lg dark:bg-slate-900/30 my-1.5 divide-y divide-slate-200/80 dark:divide-slate-700/40">
                    <div class="flex justify-between py-2.5">
                        <p class="text-lg font-semibold text-primary-600">Total</p>
                        <p class="text-lg font-semibold text-primary-600 mr-2.5 summary-total"></p>
                    </div>
                </div>
                <div class="flex py-2 space-x-2.5">
                    <button type="button"
                        class="px-4 rounded-xl text-white inline-flex items-center justify-center bg-slate-800 text-base font-semibold h-10 pay-method"
                        data-method="tunai">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4 me-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                        </svg>
                        Tunai
                    </button>
                    <button type="button"
                        class="btnSecondary px-4 rounded-xl inline-flex items-center justify-center pay-method"
                        data-method="debit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4 me-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                        </svg>
                        Debit
                    </button>
                    <button type="button"
                        class="btnSecondary px-4 rounded-xl inline-flex items-center justify-center pay-method"
                        data-method="transfer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4 me-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                        </svg>
                        Transfer
                    </button>
                    <button type="button"
                        class="btnSecondary px-4 rounded-xl inline-flex items-center justify-center pay-method"
                        data-method="qris">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4 me-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                        </svg>
                        QRIS
                    </button>

                </div>
                
                <div class="my-5">
                    <p class="mt-1 text-gray-600 dark:text-neutral-400 text-base">
                        Bayar
                    </p>
                    <p class="mt-1 text-gray-400 dark:text-neutral-500 text-5xl font-extrabold">
                        Rp <span class="text-gray-800 dark:text-neutral-200" id="paymentValue">0</span>
                    </p>
                    <p class="mt-1 text-rose-600 text-base check-pay" style="display: none;">
                        Nominal belum mencukupi.
                    </p>
                </div>
                <div class="flex flex-wrap w-full method-debit" style="display: none;">
                    <div class="my-4 w-full">
                        <x-form.label id="noRef">No Referensi</x-form.label>
                        <input class="formInput" id="noRef" name="no_ref" placeholder="Masukan no referensi" class="w-full" autocomplete="off" />
                    </div>
                    <div class="w-full">
                        <x-form.label id="noRef">Vendor</x-form.label>
                        <input class="formInput" id="noRef" name="no_ref" placeholder="Masukan no referensi" class="w-full" autocomplete="off" />
                    </div>
                    <div class="w-full mt-7 mb-3">
                        <button class="btnPrimary w-full text-center py-3 text-lg">Bayar</button>
                    </div>
                </div>
                <div class="method-tunai" id="methodTunai">
                    <div class="flex flex-wrap space-x-2.5 items-center mb-3">
                        <button type="button"
                            class="rounded-full text-amber-600 dark:text-amber-300 hover:bg-amber-600 hover:text-white inline-flex items-center justify-center bg-amber-600/10 text-sm font-medium py-2 px-4"
                            onClick="fastNumber('uang-pas')">
                            Uang Pas
                        </button>
                        <button type="button"
                            class="rounded-full text-amber-600 dark:text-amber-300 hover:bg-amber-600 hover:text-white inline-flex items-center justify-center bg-amber-600/10 text-sm font-medium py-2 px-4"
                            onClick="fastNumber(50000)">
                            50.000
                        </button>
                        <button type="button"
                            class="rounded-full text-amber-600 dark:text-amber-300 hover:bg-amber-600 hover:text-white inline-flex items-center justify-center bg-amber-600/10 text-sm font-medium py-2 px-4"
                            onClick="fastNumber(100000)">
                            100.000
                        </button>
                        <button type="button"
                            class="rounded-full text-amber-600 dark:text-amber-300 hover:bg-amber-600 hover:text-white inline-flex items-center justify-center bg-amber-600/10 text-sm font-medium py-2 px-4"
                            onClick="fastNumber(200000)">
                            200.000
                        </button>
                        <button type="button"
                            class="rounded-full text-amber-600 dark:text-amber-300 hover:bg-amber-600 hover:text-white inline-flex items-center justify-center bg-amber-600/10 text-sm font-medium py-2 px-4"
                            onClick="fastNumber(500000)">
                            500.000
                        </button>
                    </div>
                    <div class="numpad"  id="numpad">
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
                            <button type="submit" class="btnPrimary text-3xl font-extrabold h-20" id="pay" disabled>
                                Bayar
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
                </div>
            </div>
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
@push('body-scripts')
    <script>
        function payMethod(method) {
            if (method == 'tunai') {
                $('#methodTunai').show();
                $('.method-debit').hide();
                $('#paymentValue').text('0');
            } else if(method == 'debit') {
                $('#methodTunai').hide();
                $('.method-debit').show();
                let total = $("#total").val();
                $('#paymentValue').text(parseFormattedNumber(total));
            }
            checkPembayaran()

        }

        function fastNumber(nominal) {
            if (nominal === 'uang-pas') {
                let total = $("#total").val();
                $('#paymentValue').text(parseFormattedNumber(total));
            } else {
                $('#paymentValue').text(parseFormattedNumber(nominal));
            }

            checkPembayaran();
        }

        function parseFormattedNumber(formattedNumber) {
            let cleanNumber = formattedNumber.toString().replace(/\D/g, ''); // Hapus karakter selain angka
            let removeLeadingZero = cleanNumber.replace(/^0+(?=\d)/, ''); // Hapus nol hanya jika ada angka setelahnya
            return removeLeadingZero.replace(/\B(?=(\d{3})+(?!\d))/g, "."); //format ribuan
        }

        function addNumber(number) {
            if ((number == '0' || number == '00' || number == '000') && parseInt($('#paymentValue').text()) < 1) {
                $('#paymentValue').text('0');
                checkPembayaran();
                return;
            }
            if (number == 'c') {
                $('#paymentValue').text('0');
                checkPembayaran();
                return;
            }
            if (number == 'backspace') {
                let payment = $('#paymentValue').text().slice(0, -1);
                $('#paymentValue').text(parseFormattedNumber(payment));
                if (payment.length == 0) {
                    $('#paymentValue').text(0);
                    checkPembayaran();
                    return;
                }
                checkPembayaran();
                return;
            }

            let payment = $('#paymentValue').text();
            payment += number;
            $('#paymentValue').text(parseFormattedNumber(payment));

            checkPembayaran();
        }

        function checkPembayaran() {
            let total = $("#total").val();
            var pay = $("#paymentValue").text().replace(/\D/g, '');
            $('#nominalBayar').val(pay);
            if (pay.length === 0) {
                var pay = 0;
            }
            let kembalian = parseFloat(pay - total);
            $('#paymentKembalian').val(kembalian);
            if (kembalian >= 0) {
                $('.check-pay').hide();
                $('#pay').prop('disabled', false);
            } else {
                $('.check-pay').show();
                $('#pay').prop('disabled', true);
            }
        }


        $(document).ready(function() {
            $('.pay-method').on('click', function(e) {
                e.preventDefault();
                $('.pay-method').removeClass('text-white bg-slate-800').addClass(
                    'btnSecondary'
                );
                $(this).removeClass(
                        'btnSecondary'
                    )
                    .addClass('text-white bg-slate-800');
               let method = $(this).data('method');

                payMethod(method)
            });

            $("#closePayment").on('click', function(e){
                $("#paymentValue").text('0')
            })

            $('#handleProccessPayment').on('submit', function(e) {
                e.preventDefault();
                let total = $('#total').val();
                var pay = $("#paymentValue").text().replace(/\D/g, '');
                let data = $('#handleProccessPayment').serialize();

                Swal.fire({
                    title: "Konfirmasi Pembayaran",
                    html: `Pembayaran tunai sebesar: <b>${rupiah(pay)}</b>`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#9333ea",
                    cancelButtonColor: "#9ca3af",
                    confirmButtonText: "Konfirmasi",
                    cancelButtonText: "Batal",
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return new Promise((resolve, reject) => {
                            $.ajax({
                                url: "{{ route('dashboards.cashier.payment') }}",
                                type: "POST",
                                data: data, // Kirim data
                                beforeSend: function() {
                                    Swal.showLoading(); // Tampilkan loading
                                },
                                success: function(response) {
                                    resolve(
                                        response); // Berhasil, lanjutkan
                                },
                                error: function(xhr, status, error) {
                                    reject(
                                        "Terjadi kesalahan!"
                                    ); // Jika gagal, tampilkan pesan error
                                }
                            });
                        });
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (result.value.status === false) {
                            Toastify({
                                text: result.value.message,
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

                            const modal = new HSOverlay(document.querySelector(
                                '#hs-static-backdrop-modal'));
                            modal.close();
                            confetti({
                                particleCount: 350,
                                spread: 150,
                                origin: {
                                    y: 0.6
                                },
                            });
                            Swal.fire({
                                title: `Transaksi Sukses!`,
                                html: `Kembalian Rp <b>${result.value.data.kembalian || 0}</b>`,
                                icon: "success",
                                confirmButtonColor: "#9333ea",
                                confirmButtonText: "Ok",
                            }).then(() => {
                                location
                                    .reload(); // Reload halaman setelah klik "OK"
                            });
                        }

                    }
                });

                if (pay.length === 0) {
                    var pay = 0;
                }

                // if (parseFloat(total) > parseFloat(pay)) {
                //     alert('pembayaran masih kurang')
                // } else {
                //     alert('pembayaran lunas dan ada kembalian')
                // }
            });
        })
    </script>
@endpush
