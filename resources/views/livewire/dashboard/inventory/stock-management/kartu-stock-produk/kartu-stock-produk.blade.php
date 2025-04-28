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
                        <x-form.select-search id="warehouse_filter" name="warehouse_filter" wire:model.live="warehouse_filter"
                            placeholder="Pilih unit">
                            <option value="">Pilih Unit</option>
                            @foreach ($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}" wire:key="warehouse-filter-{{ $warehouse->id }}" {{ $warehouse->id == $warehouse_filter ? 'selected' : '' }}>
                                    {{ $warehouse->name }}
                                </option>
                            @endforeach
                        </x-form.select-search>
                    </div>
                    <div class="">
                        <x-form.label for="stock_filter">Stok</x-form.label>
                        <div class="flex items-center w-full">
                            <div class="w-full me-2">
                                <x-form.select-search id="status" name="stock_filter"
                                    wire:model.live="stock_filter" placeholder="Pilih status" >
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
        $tableLoading = ['warehouse_filter']
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
                        <th scope="col" class="">Satuan</th>
                        <th scope="col" class="">Stok</th>
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
                            <td class="">{{ $product->unit->name }}</td>
                            <td class="">{{ $product->quantity }}</td>
                            <td class="text-right">
                                <a href="{{ route('dashboards.inventories.stock_managements.kartu_stock_gudang.show', ['warehouse' => $product->warehouse->slug ,'slug' => $product->product->slug]) }}" class="btnPrimary"  wire:navigate>
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
