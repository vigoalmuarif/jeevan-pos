<div>
    <x-admin.heading class="pb-5" back="dashboards.inventories.procurements.request_orders.inbound_requests.index">
        Buat Permintaan Barang
    </x-admin.heading>
    <form action="" wire:submit="save()">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-5 mb-6">
            <x-card-basic class="py-5 w-full dark:border-transparent border-transparent px-4 md:col-span-6">
                <div class="grid grid-cols-1 gap-4">
                    <div class="">
                        <x-form.label for="fromWarehouse">Permintaan Dari Gudang/Cabang</x-form.label>
                        <x-form.select-search id="fromWarehouse" name="fromWarehouse" wire:model.live="fromWarehouse"
                            placeholder="Pilih unit" :disabled="count($listProducts) > 0 || $fromWarehouse ? true : false">
                            <option value="">Pilih Unit</option>
                            @foreach ($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}"
                                    {{ $warehouse->id == $fromWarehouse ? 'selected' : '' }}
                                    wire:key="from-warehouse-{{ $warehouse->id }}">
                                    {{ $warehouse->name }}
                                </option>
                            @endforeach
                        </x-form.select-search>
                    </div>
                    <div class="">
                        <x-form.label for="toWarehouse">Minta Ke Gudang/Cabang</x-form.label>
                        <x-form.select-search id="toWarehouse" name="toWarehouse" wire:model.live="toWarehouse"
                            placeholder="Pilih unit" :disabled="$fromWarehouse == null || count($listProducts) > 0 ? true : false">
                            <option value="">Pilih Unit</option>
                            @foreach ($warehouses as $warehouse)
                                @if ($warehouse->id != $fromWarehouse)
                                    <option value="{{ $warehouse->id }}"
                                        {{ $warehouse->id == $toWarehouse ? 'selected' : '' }}
                                        wire:key="to-warehouse-{{ $warehouse->id }}">
                                        {{ $warehouse->name }}
                                    </option>
                                @endif
                            @endforeach
                        </x-form.select-search>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-form.label for="date">Tanggal Permintaan</x-form.label>
                            <x-form.input type="date" name="date" id="date" wire:model.live="date"
                                value="{{ date('Y-m-d') }}" placeholder="Masukan Keterangan" autocomplete="off"
                                wire:model="requestDate" />
                        </div>
                        <div>
                            <x-form.label for="date">User Pembuat</x-form.label>
                            <x-form.input type="text" name="date" id="date" wire:model.live="date"
                                value="{{ auth()->user()->name }}" placeholder="User Pembuat" readonly
                                autocomplete="off" wire:model="user" />
                        </div>
                        <div class="col-span-2">
                            <x-form.label for="header_desc">Keterangan</x-form.label>
                            <x-form.input type="text" name="header_dec" id="header_dec" wire:model.live="header_dec"
                                placeholder="Masukan keterangan" autocomplete="off" wire:model="header_desc" />
                        </div>
                    </div>
                </div>
            </x-card-basic>
            <x-card-basic class="py-5 w-full dark:border-transparent border-transparent px-4 md:col-span-6">
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
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-4">
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
                                                                                (float) $productSelected[
                                                                                    'destinationWarehouse'
                                                                                ]['stockConversion']) /
                                                                            ($conversion->pivot->conversion_factor ??
                                                                                1);
                                                                    }
                                                                @endphp
                                                                {{ number_format(floor($stockConversion), 2) }}
                                                            </td>
                                                            <td>{{ $conversion->pivot->conversion_factor ?? 0 }}</td>
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
                            <x-form.label for="qtyWarehouse">Stok Gudang (Pengirim)</x-form.label>
                            <div class="flex items-center w-full">
                                <div class="relative w-full">
                                    <input type="text" id="qtyWarehouse" name="qtyWarehouse"
                                        class="px-4 pe-16 formInput tracking-widest w-full" placeholder="0"
                                        wire:model="productSelected.sourceWarehouse.stockConversion" disabled>
                                    <div
                                        class="absolute inset-y-0 end-0 flex items-center pointer-events-none z-20 pe-4">
                                        <span class="text-sm text-gray-500 dark:text-neutral-500">
                                            {{ $productSelected['destinationWarehouse']['unitName'] ?? '-' }}
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
                                                                            $productSelected['sourceWarehouse'][
                                                                                'stockConversionToSmall'
                                                                            ] /
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
            </x-card-basic>
        </div>
        <x-card-basic class="overflow-x-auto scrollbar-thin">
            <div class="overflow-y-auto max-h-[40vh] scrollbar-thin" id="wrapperTable">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700" id="table">
                    <thead>
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500 rounded-s-xl">
                                No</th>
                            <th scope="col"
                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                SKU</th>
                            <th scope="col"
                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Nama Barang</th>
                            <th scope="col"
                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Qty Minta</th>
                            <th scope="col"
                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Satuan</th>
                            <th scope="col"
                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Catatan</th>
                            <th scope="col"
                                class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                        @forelse ($listProducts as $index => $item)
                            @php
                                $qtyRequest = str_replace(',', '', $item['qtyRequest']);
                                // $stockWarehouse = str_replace(',', '', $item['stockWarehouse']);
                                // $stockUnit = str_replace(',', '', $item['stockUnit']);
                                // $sisaUnit = floatVal($stockUnit) + floatVal($qtyRequest);
                                // $sisaWarehouse = floatVal($stockWarehouse) - floatVal($qtyRequest);
                            @endphp
                            <tr class="hover:bg-slate-300/50 dark:hover:bg-neutral-800">
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                    {{ $item['productSku'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                    {{ $item['productName'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                    {{ number_format($item['qtyRequest'], 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                    {{ $item['satuanUnit'] }}</td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                    {{ $item['note'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                    <x-button.button-icon color="danger" name="Delete" title="Delete"
                                        wire:click="delete({{ $index }})"
                                        wire:target="delete({{ $index }})" wire:loading.attr="disabled">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </x-button.button-icon>
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
            <p>Total : {{ count($listProducts) }} Items</p>
            <div>

                <x-button type="button" class="btnSecondary py-2.5 me-2.5" wire:target="refresh,save"
                    wire:click="refresh()" :disabled="count($listProducts) == 0 ? true : false">
                    <x-slot name="loading" wire:target="refresh()">
                        Memproses...
                    </x-slot>
                    <x-slot name="default" wire:target="refresh()">
                        Reset
                    </x-slot>
                </x-button>
                <x-button type="submit" class="btnPrimary py-2.5" wire:target="save()" :disabled="count($listProducts) == 0 ? true : false">
                    <x-slot name="loading" wire:target="save()">
                        Memproses...
                    </x-slot>
                    <x-slot name="default" wire:target="save()">
                        Simpan Permintaan
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-5 ms-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                        </svg>

                    </x-slot>
                </x-button>
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
