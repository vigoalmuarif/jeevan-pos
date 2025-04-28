<div>
    <x-admin.heading class="pb-5" back="dashboards.inventories.stock_managements.kartu_stock_gudang.index">
        Detail Pergerakan Stok
    </x-admin.heading>
    <div class="flex items-center space-x-3 w-full mb-5">
        <x-card-basic class="p-2.5 w-full">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="flex flex-row items-center">
                    <div class="flex-shrink-0 w-28 h-28 md:w-40 :h-40 me-4">
                        <img src="{{ asset('storage/images/products/' . $product->product->profile_product_filename) }}"
                            class="w-28 h-28 md:w-40 md:h-40 rounded-xl object-cover" alt="{{ $product->product->name }}">
                    </div>
                    <div class="flex items-start flex-col">
                        <h6 class="mb-2.5 text-base md:text-lg ">{{ $product->product->name }}</h6>
                        <x-badge class="mb-3" color="{{ $product->product->status == 1 ? 'success' : 'danger' }}"
                            label="{{ $product->product->status == 1 ? 'Aktif' : 'Tidak Aktif' }}" />
                        <x-badge color="primary" label="{{ $product->warehouse->name }}" />
                    </div>
                </div>
                <div class="flex flex-row items-center">
                    <div class="flex items-start flex-col">
                        {{-- <p class="mb-2.5 text-slate-400 text-base">Stock</p> --}}
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
                                                    {{ ceil(number_format(($product->quantity * $product->conversion_factor) / $item->pivot->conversion_factor, 2)) }}
                                                @else
                                                    {{ floor(number_format(($product->quantity * $product->conversion_factor) / $item->pivot->conversion_factor, 2)) }}
                                                @endif
                                            </td>
                                            <td>{{ $item->pivot->conversion_factor }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </x-card-basic>
    </div>
    @php
        $tableLoading = ['warehouse_filter'];
    @endphp
    {{-- result alocations --}}
    <x-card-basic class="rounded-t-xl">
        <div class="relative">
            <x-table count="{{ count($stock_cards) }}" :tableLoading="$tableLoading">
                <x-slot:action>

                </x-slot>
                <x-slot name="heading">
                    <tr>
                        <th scope="col" class="">#</th>
                        <th scope="col" class="">Tanggal Transaksi</th>
                        <th scope="col" class="">Referensi</th>
                        <th scope="col" class="">Batch</th>
                        <th scope="col" class="">Type</th>
                        <th scope="col" class="">Satuan</th>
                        <th scope="col" class="">Qty Awal</th>
                        <th scope="col" class="">Qty</th>
                        <th scope="col" class="">Qty Akhir</th>
                        <th scope="col" class="">User Proses</th>
                        <th scope="col" class="">Keterangan</th>
                    </tr>
                </x-slot>
                <x-slot name="body">
                    @foreach ($stock_cards as $stock_card)
                        <tr>
                            <td class="w-14">
                                {{ ($stock_cards->currentPage() - 1) * $stock_cards->perPage() + $loop->iteration }}
                            </td>
                            <td>{{ date('d-m-Y H:i', strtotime($stock_card->transaction_date)) }}</td>
                            <td>{{ $stock_card->referenceable }}</td>
                            <td>{{ $stock_card->batch->batch_number ?? '-' }}</td>
                            <td>{{ $stock_card->movement_type }}</td>
                            <td>{{ $stock_card->unit->name }}</td>
                            <td>{{ $stock_card->qty_awal }}</td>
                            <td>{{ $stock_card->qty }}</td>
                            <td>{{ $stock_card->qty_akhir }}</td>
                            <td>{{ $stock_card->user->username }}</td>
                            <td>{{ $stock_card->desc }}</td>
                        </tr>
                    @endforeach

                </x-slot>
                <x-slot:paginate>
                    {{ $stock_cards->links(data: ['scrollTo' => false]) }}
                </x-slot:paginate>
            </x-table>
        </div>
    </x-card-basic>
</div>
