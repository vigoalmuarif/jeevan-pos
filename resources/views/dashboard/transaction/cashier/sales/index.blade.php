@extends('dashboard.transaction.cashier.layouts.index')

@section('title', 'Sales')

@section('contents')
    <div class="py-20">

        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 px-6">
            <x-card-basic class="md:col-span-2 p-3">
                <h6>Filter</h6>
            </x-card-basic>
            <div class=" md:col-span-10 py-2">
                <div class="min-w-full w-full">
                    <div class="rounded-none  dark:border-neutral-700 max-h-[calc(100vh-250px)]">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700 hover nowrap"
                            id="datatableSales" style="width:100%;">
                            <thead class="bg-gray-50 dark:bg-neutral-700">
                                <tr>
                                    <th class="w-14">No</th>
                                    <th class="w-14">Tgl Transaksi</th>
                                    <th class="w-14">No Transaksi</th>
                                    <th class="w-14">Branch</th>
                                    <th class="w-14">Item</th>
                                    <th class="w-14">Subtotal</th>
                                    <th class="w-14">Diskon</th>
                                    <th class="w-14">Tax</th>
                                    <th class="w-14">Total</th>
                                    <th class="w-14">Status</th>
                                    <th class="w-14">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700 ">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="salesEdit"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[9999] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="hs-scale-animation-modal-label">
        <div
            class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-2xl sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
            <div
                class="w-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                    <h3 id="hs-scale-animation-modal-label" class="font-bold text-gray-800 dark:text-white modal-title">
                        Modal title
                    </h3>
                    <button type="button"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                        aria-label="Close" data-hs-overlay="#salesEdit">
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
                    <div class="modal-content">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="py-4">
                                <x-form.input-float id="noTrans" name="no_trans" label="No Transasksi" value="121214"
                                    disabled />
                            </div>
                            <div class="py-4">
                                <x-form.input-float type="date" id="tglTrans" name="tgl_trans" label="Tgl Transasksi"
                                    value="2025-04-02" />
                            </div>
                        </div>
                    </div>
                    <div class="h-60 flex items-center justify-center loading-fetch-edit-sale" style="display:none;">
                        <div class="dt-loading-spinner me-2  animate-spin"></div>
                        <p>Sedang memuat data...</p>
                    </div>
                </div>
                <div
                    class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                    <button type="button"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                        data-hs-overlay="#salesEdit">
                        Close
                    </button>
                    <button type="button"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>


    <div id="salesShow"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[9999] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="hs-scale-animation-modal-label">
        <div
            class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 md:max-w-7xl w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
            <div
                class="w-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                    <h5 id="hs-scale-animation-modal-label" class="font-bold text-gray-800 dark:text-white modal-title">
                        Detail Penjualan
                    </h5>
                    <button type="button"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                        aria-label="Close" data-hs-overlay="#salesShow">
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
                    <div class="modal-content">
                       
                    </div>
                    <div class="h-60 flex items-center justify-center loading-fetch-edit-sale" style="display:none;">
                        <div class="dt-loading-spinner me-2  animate-spin"></div>
                        <p>Sedang memuat data...</p>
                    </div>
                </div>
                <div
                    class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                    <button type="button"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                        data-hs-overlay="#salesShow">
                        Download PDF
                    </button>
                    <button type="button"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        Cetak
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('head-scripts')
    {{-- <link rel="stylesheet" href="{{ asset('assets/library/datatables/datatables.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/library/datatables/datatables.tailwind.css') }}">
@endpush

@push('body-scripts')
    <script src="{{ asset('assets/library/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/library/datatables/datatables.tailwind.js') }}"></script>
    <script>
        function salesEdit(id) {
            const {
                element
            } = HSOverlay.getInstance('#salesEdit', true);
            element.open();
            element.on('open', (instance) => {
                // $('.modal-content').html('');
                $('.loading-fetch-edit-sale').show();
                $.ajax({
                    url: `/cashier/sales/${id}/edit`,
                    type: 'get',
                    data: {
                        saleID: id
                    },
                    success: function(response) {
                        // $('.modal-content').html('');
                    },
                    complete: function() {
                        $('.loading-fetch-edit-sale').hide();
                    }
                })
            });
        }


        function salesShow(id) {
            const {
                element
            } = HSOverlay.getInstance('#salesShow', true);
            element.open();
            element.on('open', (instance) => {
                $('.modal-content').html('');
                $('.loading-fetch-edit-sale').show();
                $.ajax({
                    url: `/cashier/sales/${id}`,
                    type: 'get',
                    success: function(response) {
                        if(response?.status == false){
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
                        element.close();
                        }else{
                            $('.modal-content').html(response);
                        }
                    },
                    complete: function() {
                        $('.loading-fetch-edit-sale').hide();
                    }
                })
            });
        }


        $(document).ready(function() {
            HSOverlay.autoInit();
            $('#datatableSales').DataTable({
                processing: true,
                serverSide: true,
                scrollCollapse: true,
                scrollY: '600px',
                ajax: '{{ route('dashboards.cashier.sales.fetch_sales') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'transaction_date',
                        name: 'transaction_date'
                    },
                    {
                        data: 'no_transaction',
                        name: 'no_transaction'
                    },
                    {
                        data: 'branch.name',
                        name: 'branch.name'
                    },
                    {
                        data: 'items_count',
                        name: 'items_count'
                    },
                    {
                        data: 'subtotal',
                        name: 'subtotal'
                    },
                    {
                        data: 'discount',
                        name: 'discount'
                    },
                    {
                        data: 'tax',
                        name: 'tax'
                    },
                    {
                        data: 'final_total',
                        name: 'final_total'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ],
                createdRow: function(row) {
                    $(row).addClass('hover:bg-gray-200'); // Tambahkan efek hover
                }
            });


        })
    </script>
@endpush
