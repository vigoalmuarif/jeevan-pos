<div>
    <x-admin.heading class="pb-5">Penyesuaian Stok</x-admin.heading>
    <x-card-basic class="mb-8 border-transparent">
        <div class="flex flex-col md:flex-row space-y-4 md:space-x-4 md:space-y-0 py-5 px-4">
            <div class="md:w-72">
                <x-form.select-search name="Gudang" id="gudang" name="form.warehouse_id"
                    placeholder="Pilih Gudang/Cabang" label="Gudang" wire:model.live="warehouse_id">
                    <option value=""></option>
                    @foreach ($warehouses as $warehouse)
                        <option value="{{ $warehouse->id }}" {{ $warehouse->id == $warehouse_id ? 'selected' : '' }}>
                            {{ $warehouse->warehouse_code }} - {{ $warehouse->name }}
                        </option>
                    @endforeach
                </x-form.select-search>
            </div>
            <div>
                <x-form.label>Dari</x-form.label>
                <input type="date" class="formInput" wire:model.live="start_date" />
            </div>
            <div>
                <x-form.label>Sampai</x-form.label>
                <input type="date" class="formInput" wire:model.live="end_date" />
            </div>
        </div>
    </x-card-basic>
    <div class="flex w-full">
        <x-card-basic class="w-full">
            <div class="">
                <x-table count="{{ $stock_adjustments->count() }}" :tableLoading="['warehouse_id']">
                    <x-slot:action>
                        <button type="button" class="btnPrimary" id="btnOpenModalStockAdjustment">
                            Tambah
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-4 inline-flex stroke-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="heading">
                        <tr>
                            <th scope="col" class="w-14">No</th>
                            <th scope="col" class="">Tgl Penyesuaian</th>
                            <th scope="col" class="">Warehouse</th>
                            <th scope="col" class="">Barang</th>
                            <th scope="col" class="">Satuan</th>
                            <th scope="col" class="">Type</th>
                            <th scope="col" class="">Stok Awal</th>
                            <th scope="col" class="">Qty</th>
                            <th scope="col" class="">Stok Akhir</th>
                            <th scope="col" class="">Selisih</th>
                            <th scope="col" class="">Alasan</th>
                            <th scope="col" class="">User Proses</th>
                        </tr>
                    </x-slot>
                    <x-slot name="body">
                        @foreach ($stock_adjustments as $stock)
                            <tr class="hover:bg-slate-200 dark:hover:bg-slate-800" wire:key="{{ $stock->id }}">
                                <td class="w-14">{{ $loop->index + 1 }}</td>
                                <td class="">{{ $stock->created_at }}</td>
                                <td class="">{{ $stock->warehouse->name }}</td>
                                <td class="">
                                    {{ str()->limit($stock->product?->sku . ' - ' . $stock->product->name, 35, '.....') }}
                                </td>
                                <td class="">{{ $stock->unit->name }}</td>
                                <td
                                    class="{{ $stock->adjusment_type == 'Increas' ? 'text-green-600' : 'text-rose-600' }}">
                                    {{ $stock->adjusment_type }}</td>
                                <td class="">{{ number_format($stock->stock_awal, 2) }}</td>
                                <td class="">{{ number_format($stock->qty, 2) }}</td>
                                <td class="">{{ number_format($stock->stock_akhir, 2) }}</td>
                                <td
                                    class="{{ number_format($stock->stock_akhir - $stock->stock_awal, 2) >= 0 ? 'text-green-600' : 'text-rose-600' }}">
                                    {{ number_format($stock->stock_akhir - $stock->stock_awal, 2) }}</td>
                                <td class="">{{ $stock->reason }}</td>
                                <td class="">{{ $stock->user->username }}</td>
                            </tr>
                        @endforeach

                    </x-slot>
                    <x-slot:paginate>
                        {{ $stock_adjustments->links(data: ['scrollTo' => false]) }}
                    </x-slot:paginate>
                </x-table>
            </div>
        </x-card-basic>
    </div>
    <livewire:dashboard.inventory.stock-management.stock-adjustment.create-stock-adjustment />
</div>
