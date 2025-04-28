<div>
    <form action="" wire:submit="save()">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-5 mb-6">
            <x-card-basic class="py-5 w-full dark:border-transparent border-transparent px-4 md:col-span-6">
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-x-4 gap-y-6">
    
                    <div class="flex flex-row items-center">
                        <div class="flex-shrink-0 me-2.5 bg-primary-200/70 rounded-xl dark:bg-primary-700/20 p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6 stroke-primary-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500">No Transaksi</p>
                            <p class="text-sm font-medium text-slate-700 dark:text-slate-300">
                                {{ $requestOrder->no_order }}</p>
                        </div>
                    </div>
    
                    <div class="flex flex-row items-center">
                        <div class="flex-shrink-0 me-2.5 bg-primary-200/70 rounded-xl dark:bg-primary-700/20 p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6 stroke-primary-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500">Tanggal Permintaan</p>
                            <p class="text-sm font-medium text-slate-700 dark:text-slate-300">
                                {{ date('d-m-Y H:i', strtotime($requestOrder->request_at)) }}</p>
                        </div>
                    </div>
    
                    <div class="flex flex-row items-center">
                        <div class="flex-shrink-0 me-2.5 bg-primary-200/70 rounded-xl dark:bg-primary-700/20 p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6 stroke-primary-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500">Pembuat</p>
                            <p class="text-sm font-medium text-slate-700 dark:text-slate-300">
                                {{ $requestOrder->user->username }}</p>
                        </div>
                    </div>
    
                    <div class="flex flex-row items-center">
                        <div class="flex-shrink-0 me-2.5 bg-primary-200/70 rounded-xl dark:bg-primary-700/20 p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6 stroke-primary-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500">Permintaan</p>
                            <p class="text-sm font-medium text-slate-700 dark:text-slate-300">
                                {{ $requestOrder->from_warehouse->name }}</p>
                        </div>
                    </div>
    
                    <div class="flex flex-row items-center">
                        <div class="flex-shrink-0 me-2.5 bg-primary-200/70 rounded-xl dark:bg-primary-700/20 p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6 stroke-primary-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500">Tujuan</p>
                            <p class="text-sm font-medium text-slate-700 dark:text-slate-300">
                                {{ $requestOrder->to_warehouse->name }}</p>
                        </div>
                    </div>
    
                    <div class="flex flex-row items-center">
                        <div class="flex-shrink-0 me-2.5 bg-primary-200/70 rounded-xl dark:bg-primary-700/20 p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6 stroke-primary-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500">Status</p>
                            <p class="text-sm font-medium text-slate-700 dark:text-slate-300">
                                @if ($requestOrder->status == 'draft')
                                    <span
                                        class="rounded-full text-sm font-medium  text-gray-500  dark:text-white">Draft</span>
                                @elseif ($requestOrder->status == 'requested')
                                    <span
                                        class="rounded-full text-sm font-medium bg-gray-100 text-gray-800  dark:text-white">Requested</span>
                                @elseif ($requestOrder->status == 'reviewed')
                                    <span
                                        class="rounded-full text-sm font-medium text-sky-800 dark:text-sky-500">Reviewed</span>
                                @elseif ($requestOrder->status == 'approved')
                                    <span
                                        class="rounded-full text-sm font-medium text-teal-800 dark:text-teal-500">Approved</span>
                                @elseif ($requestOrder->status == 'partial_approved')
                                    <span
                                        class="rounded-full text-sm font-medium text-amber-800 dark:text-amber-500">Partial
                                        Approved</span>
                                @elseif ($requestOrder->status == 'ready_to_send')
                                    <span
                                        class="rounded-full text-sm font-medium text-indigo-800 dark:text-indigo-500">Ready
                                        to Send</span>
                                @elseif ($requestOrder->status == 'shipped')
                                    <span
                                        class="rounded-full text-sm font-medium text-purple-800 dark:text-purple-500">Shipped</span>
                                @elseif ($requestOrder->status == 'received')
                                    <span
                                        class="rounded-full text-sm font-medium text-lime-800 dark:text-lime-500">Recevied</span>
                                @elseif ($requestOrder->status == 'completed')
                                    <span
                                        class="rounded-full text-sm font-medium text-green-800  dark:text-green-500">Completed</span>
                                @elseif ($requestOrder->status == 'rejected')
                                    <span
                                        class="rounded-full text-sm font-medium text-rose-800 dark:text-rose-500">Rejected</span>
                                @elseif ($requestOrder->status == 'cancelled')
                                    <span
                                        class="rounded-full text-sm font-medium text-red-800 dark:text-red-500">Cancelled</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </x-card-basic>
            <x-card-basic class="py-5 w-full dark:border-transparent border-transparent px-4 md:col-span-6">
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-x-4 gap-y-6">
    
                    <div class="flex flex-row items-center">
                        <div class="flex-shrink-0 me-2.5 bg-cyan-200/70 rounded-xl dark:bg-cyan-700/20 p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6 stroke-cyan-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500">Total Items</p>
                            <p class="text-sm font-medium text-slate-700 dark:text-slate-300">
                                {{ count($requestOrderItems) }} Item</p>
                        </div>
                    </div>
    
                    <div class="flex flex-row items-center">
                        <div class="flex-shrink-0 me-2.5 bg-gray-200/70 rounded-xl dark:bg-gray-700/20 p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                class="size-6 stroke-gray-700 dark:stroke-gray-300">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500">Belum Diproses</p>
                            <p class="text-sm font-medium text-slate-700 dark:text-slate-300">
                                {{ $calculatePending }} Item</p>
                        </div>
                    </div>
    
                    <div class="flex flex-row items-center">
                        <div class="flex-shrink-0 me-2.5 bg-rose-200/70 rounded-xl dark:bg-rose-700/20 p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6 stroke-rose-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500">Rejected</p>
                            <p class="text-sm font-medium text-slate-700 dark:text-slate-300">
                                {{ $totalReject }} Item</p>
                        </div>
                    </div>
    
                    <div class="flex flex-row items-center">
                        <div class="flex-shrink-0 me-2.5 bg-amber-200/70 rounded-xl dark:bg-amber-700/20 p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6 stroke-amber-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500">Partial</p>
                            <p class="text-sm font-medium text-slate-700 dark:text-slate-300">
                                {{ $totalPartial }} Item</p>
                        </div>
                    </div>
    
                    <div class="flex flex-row items-center">
                        <div class="flex-shrink-0 me-2.5 bg-emerald-200/70 rounded-xl dark:bg-emerald-700/20 p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6 stroke-emerald-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500">FulFilled</p>
                            <p class="text-sm font-medium text-slate-700 dark:text-slate-300">
                                {{ $totalFulFilled }} Item</p>
                        </div>
                    </div>
    
                </div>
            </x-card-basic>
            {{-- <x-card-basic class="py-5 w-full dark:border-transparent border-transparent px-4 md:col-span-6">
                <div class="flex flex-wrap w-full">
                    <div class="w-full mb-4">
                        <x-form.label for="searchProduct">Cari Produk</x-form.label>
                        <x-form.select-search class="w-full" id="searchProduct" name="searchProduct"
                            wire:model.live="searchProduct" placeholder="Cari Produk" onChange="handleSearchProduct()"
                            :disabled="$fromWarehouse == null || $toWarehouse == null ? true : false">
                            <option value="">Pilih Product</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}"
                                    {{ $product->id == $searchProduct ? 'selected' : '' }}
                                    wire:key="warehouse-filter-{{ $product->id }}">
                                    [{{ $product->sku }}] {{ $product->name }} -
                                    @foreach ($product->alocations as $item)
                                        {{ number_format($item->quantity, 2) . ' ' . $item->unit->name }}
                                    @endforeach
                                </option>
                            @endforeach
                        </x-form.select-search>
                        <p wire:loading wire:target="fromWarehouse">
                            Memuat produk....
                        </p>
                    </div>
                    <div class="grid grid-cols-2 w-full gap-4">
                        <div class="qty-unit w-full">
                            <x-form.label for="qtyUnit">Stok Unit</x-form.label>
                            <div class="flex items-center">
                                <div class="relative w-full">
                                    <input type="text" id="qtyUnit" name="qtyUnit"
                                        class="px-4 pe-16 formInput tracking-widest w-full" placeholder="0"
                                        wire:model="productSelected.destinationWarehouse.stockConversion" disabled>
                                    <div
                                        class="absolute inset-y-0 end-0 flex items-center pointer-events-none z-20 pe-4">
                                        <span
                                            class="text-sm text-gray-500 dark:text-neutral-500">{{ $productSelected['destinationWarehouse']['unitName'] ?? '-' }}</span>
                                    </div>
                                </div>
                                <!-- popper -->
                                <div class="hs-tooltip [--trigger:hover] sm:[--placement:right] inline-block ms-2">
                                    <div
                                        class="hs-tooltip-toggle max-w-xs p-2 flex items-center gap-x-3 bg-white border border-gray-200 rounded-full shadow-2xs dark:bg-neutral-900 dark:border-neutral-700">
    
                                        <!-- Content -->
                                        <div class="">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.098 19.902a3.75 3.75 0 0 0 5.304 0l6.401-6.402M6.75 21A3.75 3.75 0 0 1 3 17.25V4.125C3 3.504 3.504 3 4.125 3h5.25c.621 0 1.125.504 1.125 1.125v4.072M6.75 21a3.75 3.75 0 0 0 3.75-3.75V8.197M6.75 21h13.125c.621 0 1.125-.504 1.125-1.125v-5.25c0-.621-.504-1.125-1.125-1.125h-4.072M10.5 8.197l2.88-2.88c.438-.439 1.15-.439 1.59 0l3.712 3.713c.44.44.44 1.152 0 1.59l-2.879 2.88M6.75 17.25h.008v.008H6.75v-.008Z" />
                                            </svg>
                                        </div>
                                        <!-- End Content -->
    
                                        <!-- Popover Content -->
                                        <div class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible hidden opacity-0 transition-opacity absolute invisible z-[999] max-w-xs w-full bg-white border border-gray-100 text-start rounded-xl shadow-md after:absolute after:top-0 after:-start-4 after:w-4 after:h-full dark:bg-neutral-800 dark:border-neutral-700"
                                            role="tooltip">
                                            <!-- Header -->
                                            <div class="py-2 px-4 border-b border-gray-200 dark:border-neutral-700">
                                                <div class="flex items-center gap-x-3">
                                                    <p class="text-sm text-gray-500 dark:text-neutral-500">
                                                        Konversi Satuan
                                                    </p>
                                                </div>
                                            </div>
                                            <!-- End Header -->
    
                                            <!-- table -->
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Satuan</th>
                                                        <th>Qty</th>
                                                        <th>Index</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($productSelected['destinationWarehouse']['units'] ?? [] as $conversion)
                                                        <tr>
                                                            <td>{{ $conversion->name }}</td>
                                                            <td>
                                                                @php
                                                                    if (
                                                                        (float) $productSelected[
                                                                            'destinationWarehouse'
                                                                        ]['qtyConversion'] == 0
                                                                    ) {
                                                                        $stockConversion = 0; // atau kasih warning
                                                                    } else {
                                                                        $stockConversion =
                                                                            ($productSelected['destinationWarehouse'][
                                                                                'qtyConversion'
                                                                            ] *
                                                                                $productSelected[
                                                                                    'destinationWarehouse'
                                                                                ]['stockConversion']) /
                                                                            ($conversion->pivot->conversion_factor ??
                                                                                1);
                                                                    }
                                                                @endphp
                                                                {{ floor(number_format($stockConversion, 2)) }}
                                                            </td>
                                                            <td>{{ $conversion->pivot?->conversion_factor ?? 0 }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <!-- End table -->
                                        </div>
                                        <!-- End Popover Content -->
                                    </div>
                                </div>
                                <!-- End popper -->
                            </div>
                        </div>
                        <div class="qty-warehouse w-full">
                            <x-form.label for="qtyWarehouse">Stok Gudang</x-form.label>
                            <div class="flex items-center w-full">
                                <div class="relative w-full">
                                    <input type="text" id="qtyWarehouse" name="qtyWarehouse"
                                        class="px-4 pe-16 formInput tracking-widest w-full" placeholder="0"
                                        wire:model="productSelected.sourceWarehouse.stockConversion" disabled>
                                    <div
                                        class="absolute inset-y-0 end-0 flex items-center pointer-events-none z-20 pe-4">
                                        <span class="text-sm text-gray-500 dark:text-neutral-500">
                                            {{ $productSelected['sourceWarehouse']['unitName'] ?? '-' }}
                                        </span>
                                    </div>
                                </div>
                                <!-- popper -->
                                <div class="hs-tooltip [--trigger:hover] sm:[--placement:right] inline-block ms-2">
                                    <div
                                        class="hs-tooltip-toggle max-w-xs p-2 flex items-center gap-x-3 bg-white border border-gray-200 rounded-full shadow-2xs dark:bg-neutral-900 dark:border-neutral-700">
    
                                        <!-- Content -->
                                        <div class="">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4.098 19.902a3.75 3.75 0 0 0 5.304 0l6.401-6.402M6.75 21A3.75 3.75 0 0 1 3 17.25V4.125C3 3.504 3.504 3 4.125 3h5.25c.621 0 1.125.504 1.125 1.125v4.072M6.75 21a3.75 3.75 0 0 0 3.75-3.75V8.197M6.75 21h13.125c.621 0 1.125-.504 1.125-1.125v-5.25c0-.621-.504-1.125-1.125-1.125h-4.072M10.5 8.197l2.88-2.88c.438-.439 1.15-.439 1.59 0l3.712 3.713c.44.44.44 1.152 0 1.59l-2.879 2.88M6.75 17.25h.008v.008H6.75v-.008Z" />
                                            </svg>
                                        </div>
                                        <!-- End Content -->
    
                                        <!-- Popover Content -->
                                        <div class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible hidden opacity-0 transition-opacity absolute invisible z-[999] max-w-xs w-full bg-white border border-gray-100 text-start rounded-xl shadow-md after:absolute after:top-0 after:-start-4 after:w-4 after:h-full dark:bg-neutral-800 dark:border-neutral-700"
                                            role="tooltip">
                                            <!-- Header -->
                                            <div class="py-2 px-4 border-b border-gray-200 dark:border-neutral-700">
                                                <div class="flex items-center gap-x-3">
                                                    <p class="text-sm text-gray-500 dark:text-neutral-500">
                                                        Konversi Satuan
                                                    </p>
                                                </div>
                                            </div>
                                            <!-- End Header -->
    
                                            <!-- table -->
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Satuan</th>
                                                        <th>Qty</th>
                                                        <th>Index</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($productSelected['sourceWarehouse']['units'] ?? [] as $item)
                                                        <tr>
                                                            <td>{{ $item->name }}</td>
    
                                                            <td>
                                                                @php
                                                                    if (
                                                                        (float) $productSelected['sourceWarehouse'][
                                                                            'stockConversion'
                                                                        ] == 0
                                                                    ) {
                                                                        $stockConversion = 0; // atau kasih warning
                                                                    } else {
                                                                        $stockConversion =
                                                                            ($productSelected['sourceWarehouse'][
                                                                                'qtyConversion'
                                                                            ] *
                                                                                $productSelected['sourceWarehouse'][
                                                                                    'stockConversion'
                                                                                ]) /
                                                                            ($item->pivot->conversion_factor ?? 1);
                                                                    }
                                                                @endphp
                                                                {{ number_format($stockConversion, 2) }}
                                                            </td>
                                                            <td>{{ $item->pivot->conversion_factor ?? 0 }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <!-- End table -->
                                        </div>
                                        <!-- End Popover Content -->
                                    </div>
                                </div>
                                <!-- End popper -->
                            </div>
                        </div>
                        <div class="qty-request w-full">
                            <x-form.label for="qtyRequest">Qty Minta</x-form.label>
                            <div class="relative">
                                <input type="text" id="qtyRequest" class="px-4 pe-16 formInput" placeholder="0"
                                    wire:model="qtyRequest" onkeyup="cekStockWarehouse()"onclick="this.select()"
                                    autocomplete="off" />
                                <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none z-20 pe-4">
                                    <span
                                        class="text-sm text-gray-500 dark:text-neutral-500">{{ $productSelected['destinationWarehouse']['unitName'] ?? '-' }}</span>
                                </div>
                            </div>
                            <p class="isInvalidMessage warning-qty-request" id="warningQtyRequest"></p>
                        </div>
                        <div class="desc w-full">
                            <x-form.label for="note">Keterangan</x-form.label>
                            <x-form.input name="note" id="note" placeholder="Masukan Keterangan"
                                autocomplete="off" wire:model="note" />
                        </div>
                    </div>
                    <div class="xl:grow self-end w-full xl:w-auto pt-5">
                        <x-button type="button" id="handleBtnAdd" class="btnPrimary py-2.5 w-full"
                            wire:target="addProduct()" wire:click="addProduct()" :disabled="true">
                            <x-slot name="loading" wire:target="addProduct()">
                                Memproses...
                            </x-slot>
                            <x-slot name="default" wire:target="addProduct()">
                                Tambah
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-5 stroke-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
    
                            </x-slot>
                        </x-button>
                    </div>
                </div>
            </x-card-basic> --}}
        </div>
        <x-card-basic class="overflow-x-auto scrollbar-thin">
            <div class="overflow-y-auto max-h-[40vh] scrollbar-thin" id="wrapperTable">
                <table class="min-w-full divide-y table-auto divide-gray-200 dark:divide-neutral-700" id="table">
                    <thead>
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 whitespace-nowrap text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500 rounded-s-xl">
                                No</th>
                            <th scope="col"
                                class="px-6 py-3 whitespace-nowrap  text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                SKU</th>
                            <th scope="col"
                                class="px-6 py-3 whitespace-nowrap  text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Nama Barang</th>
                            <th scope="col"
                                class="px-6 py-3 whitespace-nowrap  text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Satuan</th>
                            <th scope="col"
                                class="px-6 py-3 whitespace-nowrap  text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Qty Minta</th>
                            {{-- <th scope="col"
                                class="px-6 py-3 whitespace-nowrap  text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Sat. Minta</th> --}}
                            <th scope="col"
                                class="px-6 py-3 whitespace-nowrap  text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Qty Approved</th>
                            {{-- <th scope="col"
                                class="px-6 py-3 whitespace-nowrap  text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Sat. Approved</th> --}}
                            <th scope="col"
                                class="px-6 py-3 whitespace-nowrap  text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Stok Unit</th>
                            {{-- <th scope="col"
                                class="px-6 py-3 whitespace-nowrap  text-start text-xs  font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Total</th> --}}
                            {{-- <th scope="col"
                                class="px-6 py-3 whitespace-nowrap  text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Sat. Unit</th> --}}
                            <th scope="col"
                                class="px-6 py-3 whitespace-nowrap  text-start text-xsfont-medium text-gray-500 uppercase dark:text-neutral-500">
                                Stok Gudang</th>
                            {{-- <th scope="col"
                                class="px-6 py-3 whitespace-nowrap  text-start text-xsfont-medium text-gray-500 uppercase dark:text-neutral-500">
                                Sat. Gudang</th> --}}
                            <th scope="col"
                                class="px-6 py-3 whitespace-nowrap  text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Catatan Peminta</th>
                            <th scope="col"
                                class="px-6 py-3 whitespace-nowrap  text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Alasan Tolak</th>
                            <th scope="col"
                                class="px-6 py-3 whitespace-nowrap  text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Status</th>
                            <th scope="col"
                                class="px-6 py-3 whitespace-nowrap  text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300 dark:divide-neutral-700">
                        @forelse ($requestOrderItems as $index => $item)
                            @php
                                $qty_request = $item['qty_request'];
                                $stockWarehouse = $item['stock_source_warehouse'];
                                $stockUnit = $item['stock_destination_warehouse'];
                                $sisaUnit = floatVal($stockUnit) + floatVal($qty_request);
                                $sisaWarehouse = floatVal($stockWarehouse) - floatVal($qty_request);
                            @endphp
                            <tr class="@if ($item['status'] == 'rejected') bg-rose-600/10 hover:bg-rose-600/20 dark:hover:bg-rose-600/20 @elseif($item['status'] == 'approved') bg-green-600/10 hover:bg-green-600/20 dark:hover:bg-green-600/20 @elseif($item['status'] == 'partial_approved') bg-amber-600/10 hover:bg-amber-600/20 dark:hover:bg-amber-600/20  @elseif($item['status'] == 'over_qty') bg-violet-600/10 hover:bg-violet-600/20 dark:hover:bg-violet-600/20  @else {{ '' }} @endif group"
                                wire:key="product-validation-{{ $item['id'] }}">
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                    {{ $item['product']['sku'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                    {{ $item['product']['name'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm  text-gray-800 dark:text-neutral-200">
                                    {{ $item['request_order_product_unit_name'] }}</td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200 tracking-widest">
                                    {{ number_format($item['qty_request'], 2) }}</td>
                                {{-- <td class="px-6 py-4 whitespace-nowrap text-sm  text-gray-800 dark:text-neutral-200">
                                    {{ $item->unit->name }}</td> --}}
                                <td
                                    class="px-6 py-4 whitespace-nowrap max-w-28 text-sm text-gray-800 dark:text-neutral-200 tracking-widest">
                                    <x-form.input
                                        class="text-slate-700 dark:text-slate-200 disabled:text-slate-500 disabled:dark:text-slate-300 group-hover:border-primary-500 group-hover:dark:border-primary-500  group-hover:disabled:dark:border-transparent"
                                        wire:model.debounce.700ms="requestOrderItems.{{ $index }}.qtyApproved"
                                        wire:keyup.debounce.700ms="validasiQtyApproved({{ $index }})"
                                        onclick="this.select()" type="text" disabled="{{ $item['status'] == 'rejected' && ($item['status'] != 'requested' || $item['status'] != 'reviewed') ? true : false }}" />
                                </td>
                                {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                    <x-form.select wire:model="requestOderItems.{{ $index }}.satuanApproved" :disabled="$item['reject'] || $item['approve'] ">
                                        <option value="">Pilih Satuan</option>
                                        @foreach ($item['product']['product_unit_conversions'] as $unit)
                                            <option value="{{ $unit['id'] }}"
                                                {{ $unit['id'] == $item['product_unit_id'] ? 'selected' : '' }}>
                                                {{ $unit['name'] }}</option>
                                        @endforeach
                                    </x-form.select>
                                </td> --}}
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200 tracking-widest">
                                    {{ number_format($stockUnit, 2) }}</td>
                                {{-- <td
                                    class="px-6 py-4 whitespace-nowrap text-sm bg-yellow-600/10 text-gray-800 dark:text-neutral-200">
                                    {{ number_format($sisaUnit, 2) }}</td> --}}
                                {{-- <td
                                    class="px-6 py-4 whitespace-nowrap text-sm bg-yellow-600/10 text-gray-800 dark:text-neutral-200">
                                    {{ $item->unitDestinationWarehouse->name }}</td> --}}
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-neutral-200 tracking-widest">
                                    {{ number_format($item['sisa_source_warehouse'], 2) }}
                                </td>
                                {{-- <td
                                    class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-neutral-200">
                                    {{ $item->unitSourceWarehouse->name }}</td> --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                    {{ $item['note'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                    {{ $item['reject_reason'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                    @if ($item['status'] == '')
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-gray-50 text-gray-500 dark:bg-white/10 dark:text-white">Belum
                                            Diproses</span>
                                    @elseif ($item['status'] == 'partial_approved')
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-800/30 dark:text-amber-500">Partial
                                            Approved</span>
                                    @elseif ($item['status'] == 'approved')
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-300">Full
                                            Approved</span>
                                    @elseif ($item['status'] == 'rejected')
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-300">Ditolak</span>
                                    @elseif ($item['status'] == 'over_qty')
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-violet-100 text-violet-600 dark:bg-violet-800/30 dark:text-violet-300">Over
                                            Qty</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                    {{-- jika status header approved --}}
                                    @if ($requestOrder->status != 'reviewed' && $requestOrder->status != 'requested')
                                        @if ($item['status'] == 'approved')
                                            <button type="button" class="px-4 py-1 bg-emerald-600 rounded-xl"
                                                :disabled="true">
                                                Approved
                                            </button>
                                        @elseif($item['status'] == 'partial_approved')
                                            <button type="button" class="px-4 py-1 bg-amber-600 rounded-xl"
                                                :disabled="true">
                                                Partial Approved
                                            </button>
                                        @else
                                            <button type="button" class="px-4 py-1 bg-rose-600 rounded-xl"
                                                :disabled="true">
                                                Rejected
                                            </button>
                                        @endif
                                    @else
                                        {{-- status untuk item barang --}}
                                        {{-- reject true --}}
                                        @if ($item['status'] == 'rejected')
                                            <button type="button" class="px-4 py-1 text-white bg-rose-600 rounded-xl "
                                                wire:target="reject({{ $index }})"
                                                wire:loading.attr="disabled"
                                                wire:click="reject({{ $index }})">
                                                {{ $item['status'] == 'rejected' ? 'Batal Tolak' : 'Tolak' }}
                                            </button>
                                            {{-- default --}}
                                        @else
                                            <button type="button" class="px-4 py-1 text-white bg-rose-600 rounded-xl"
                                                wire:target="reject({{ $index }})"
                                                wire:loading.attr="disabled"
                                                wire:click="reject({{ $index }})">
                                                {{ $item['status'] == 'rejected' ? 'Batal Tolak' : 'Tolak' }}
                                            </button>
                                        @endif
                                    @endif
    
    
                                </td>
                            </tr>
                        @empty
                            <tr class="">
                                <td colspan="1000" class="text-center">
                                    <div
                                        class="flex flex-col items-center justify-center py-3 text-sm font-medium text-gray-900 dark:text-white w-full">
                                        <img src="{{ asset('assets/media/img/relax.png') }}"
                                            class="w-auto h-32 mb-2 bg-transparent" alt="no-data">
                                        <p>Oops, no data found!</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-card-basic>
        <div class="flex justify-between items-start pt-5">
            <p>Total : {{ count($requestOrderItems) }} Items</p>
            <div>
                @if ($requestOrder->status == 'requested' || $requestOrder->status == 'reviewed' || $requestOrder->status == 'rejected')
                    <a href="{{ route('dashboards.inventories.procurements.request_orders.pdf', $requestOrder->no_order) }}"
                        target="_blank" class="btnSecondary py-2.5 me-2.5" rel="noopener noreferrer">Cetak</a>
                    <x-button type="button"
                        class="btnSecondary bg-rose-600 hover:bg-rose-500 disabled:bg-rose-500/40 py-2.5 me-2.5"
                        wire:target="refresh,save" wire:click="refresh()" :disabled="count($requestOrderItems) == 0 || $requestOrder->status == 'rejected' ? true : false">
                        <x-slot name="loading" wire:target="refresh()">
                            Memproses...
                        </x-slot>
                        <x-slot name="default" wire:target="refresh()">
                            Tolak Permintaan
                        </x-slot>
                    </x-button>
                @endif
                @if ($showProsesSimpan)
                    @if ($requestOrder->status == 'partial_approved' && $requestOrder->status != 'rejected')
                        <x-button type="submit" class="btnPrimary py-2.5" wire:target="save()" :disabled="count($requestOrderItems) == 0 ? true : false">
                            <x-slot name="loading" wire:target="save()">
                                Memproses...
                            </x-slot>
                            <x-slot name="default" wire:target="save()">
                                Proses Partial Approved
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-5 ms-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                </svg>
    
                            </x-slot>
                        </x-button>
                    @endif
                    @if (
                        ($requestOrder->status == 'requested' || $requestOrder->status == 'reviewed') &&
                            $requestOrder->status != 'rejected')
                        <x-button type="submit" class="btnPrimary py-2.5" wire:target="save()" :disabled="count($requestOrderItems) == 0 ? true : false">
                            <x-slot name="loading" wire:target="save()">
                                Memproses...
                            </x-slot>
                            <x-slot name="default" wire:target="save()">
                                Approved
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-5 ms-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                </svg>
    
                            </x-slot>
                        </x-button>
                    @endif
                @endif
            </div>
        </div>
    </form>
</div>

@push('body-scripts')
    <script>
        function cekStockWarehouse() {
            let qtyRequest = $("#qtyRequest").val();
            let qtyWarehouse = $("#qtyWarehouse").val();

            if (parseFloat(qtyRequest.replace(/,/g, '')) > parseFloat(qtyWarehouse.replace(/,/g, ''))) {
                setTimeout(() => {
                    $("#warningQtyRequest").text('Melebihi stok gudang')
                }, 800);
            } else {
                $("#warningQtyRequest").text('')
            }

            handleBtnAdd()

        }

        function handleSearchProduct() {
            let searchProduct = $("#searchProduct").val();

            setTimeout(() => {
                if (searchProduct) {
                    $("#qtyRequest").focus();
                    $("#qtyRequest").select();
                }
            }, 500);

        }

        function handleBtnAdd() {
            let searchProduct = $("#searchProduct").val();
            let qtyRequest = $("#qtyRequest").val();
            let qtyWarehouse = $("#qtyWarehouse").val();

            if (searchProduct && (qtyRequest.replace(/,/g, '') != '' || qtyRequest.replace(/,/g, '') != 0) && (parseFloat(
                    qtyRequest.replace(/,/g, '')) <= parseFloat(
                    qtyWarehouse.replace(/,/g, '')))) {
                $("#handleBtnAdd").prop('disabled', false);
            } else {
                $("#handleBtnAdd").prop('disabled', true);
            }
        }

        $(document).ready(function() {
            Livewire.on('added-item', () => {
                var $wrapper = $('#wrapperTable');
                $wrapper.animate({
                    scrollTop: $wrapper[0].scrollHeight
                }, 300);
            })
        })
    </script>
@endpush