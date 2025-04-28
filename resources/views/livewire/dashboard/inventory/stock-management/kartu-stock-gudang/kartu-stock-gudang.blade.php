<div>
    <x-admin.heading class="pb-5" back="dashboards.inventories.products.index">
        Pergerakan Stok
    </x-admin.heading>

    <div class="flex items-center space-x-3 w-full mb-5">
        <x-card-basic class="p-2.5 w-full">
            <form wire:submit="filterKartuStockGudang">
                <div class="grid grid-cols-2  md:grid-cols-4  gap-4 pb-2">
                    <div class="">
                        <x-form.label for="warehouse_filter">Warehouse / Branch</x-form.label>
                        <x-form.select-search id="warehouse_filter" name="warehouse_filter"
                            wire:model.live="warehouse_filter" placeholder="Pilih unit">
                            <option value="">Pilih Unit</option>
                            @foreach ($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}" wire:key="warehouse-filter-{{ $warehouse->id }}"
                                    {{ $warehouse->id == $warehouse_filter ? 'selected' : '' }}>
                                    {{ $warehouse->name }}
                                </option>
                            @endforeach
                        </x-form.select-search>
                    </div>
                    <div class="">
                        <x-form.label for="stock_filter">Stok</x-form.label>
                        <div class="flex items-center w-full">
                            <div class="w-full me-2">
                                <x-form.select-search id="status" name="stock_filter" wire:model.live="stock_filter"
                                    placeholder="Pilih status">
                                    <option value="1" {{ 1 == $stock_filter ? 'selected' : '' }}>
                                        Semua</option>
                                    <option value="2" {{ 2 == $stock_filter ? 'selected' : '' }}>
                                        Tidak Nol</option>
                                    <option value="3" {{ 3 == $stock_filter ? 'selected' : '' }}>
                                        Nol</option>
                                    <option value="4" {{ 4 == $stock_filter ? 'selected' : '' }}>
                                        Minus</option>
                                </x-form.select-search>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </x-card-basic>
    </div>
    @php
        $tableLoading = ['warehouse_filter'];
    @endphp

    {{-- result alocations --}}
    <x-card-basic class="rounded-t-xl">
        <div class="relative">
            <x-table count="{{ count($products) }}" :tableLoading="$tableLoading">
                <x-slot:action>

                </x-slot>
                <x-slot name="heading">
                    <tr>
                        <th scope="col" class="">#</th>
                        <th scope="col" class="">SKU</th>
                        <th scope="col" class="">Nama Produk</th>
                        <th scope="col" class="">Stok</th>
                        <th scope="col" class="">Satuan</th>
                        <th scope="col" class="text-right">Action</th>
                    </tr>
                </x-slot>
                <x-slot name="body">
                    @foreach ($products as $product)
                        <tr>
                            <td class="w-14">
                                {{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}
                            </td>
                            <td class="">{{ $product->product->sku }}</td>
                            <td class="">{{ $product->product->name }}</td>
                            <td class="">{{ number_format($product->quantity * $product->conversion_factor , 2) }}</td>
                            <td class="">
                                <div class="flex items-center space-x-2.5">
                                    <p>{{ $product->product->base_unit->name }}</p>
                                    <!-- popper -->
                                    <div class="hs-tooltip [--trigger:hover] sm:[--placement:right] inline-block">
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
                                                        @foreach ($product->product->product_unit_conversions as $item)
                                                            @if ($product->conversion_factor >= $item->pivot->conversion_factor)
                                                                <tr>
                                                                    <td>{{ $item->name }}</td>
                                                                    <td>
                                                                        @if ($item->pivot->conversion_factor == 1)
                                                                            {{ number_format(ceil(($product->quantity * $product->conversion_factor) / $item->pivot->conversion_factor), 2) }}
                                                                        @else
                                                                            {{ number_format(floor(($product->quantity * $product->conversion_factor) / $item->pivot->conversion_factor), 2) }}
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $item->pivot->conversion_factor }}</td>
                                                                </tr>
                                                            @endif
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
                            </td>
                            <td class="text-right">
                                <a href="{{ route('dashboards.inventories.stock_managements.kartu_stock_gudang.show', ['warehouse' => $product->warehouse->slug, 'slug' => $product->product->slug]) }}"
                                    class="btnPrimary" wire:navigate>
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </x-slot>
                <x-slot:paginate>
                    {{ $products->links(data: ['scrollTo' => false]) }}
                </x-slot:paginate>
            </x-table>
        </div>
    </x-card-basic>
</div>
