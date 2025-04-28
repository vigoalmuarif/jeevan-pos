<div>
    <x-alert color="info">
        Harga produk otomatis terbentuk berdasarkan alokasi unit yang memiliki status aktif penjualan.
    </x-alert>
    @foreach ($alocations as $alocation)
        <x-card-basic class="mt-4" >
            <x-slot:title>
                {{ str()->title($alocation->warehouse->name) }}
            </x-slot:title>
            <div class="relative">
                <x-table count="{{ $alocations->count() }}" :perPage="false" :search="false"
                    rounded_top="rounded-t-xl">
                    <x-slot:action>

                    </x-slot>
                    <x-slot name="heading">
                        <tr>
                            <th scope="col" class="">Satuan</th>
                            <th scope="col" class="">Index</th>
                            <th scope="col" class="">Konversi Qty</th>
                            <th scope="col" class="">Harga Beli</th>
                            <th scope="col" class="">Harga Jual</th>
                            <th scope="col" class="">Jual Onlie</th>
                            <th scope="col" class="">Status</th>
                            <th scope="col" class="text-right">Action</th>
                        </tr>
                    </x-slot>
                    <x-slot name="body">
                        @foreach ($prices as $index => $price)
                            @if ($price->warehouse_id == $alocation->location_id)
                            <tr class="hover:bg-slate-200 dark:hover:bg-slate-800" wire:key="{{ $price->id }}">
                                {{-- @php
                                    $base_unit = $product->base_unit_id == $price->unit->id ? $index : '';
                                @endphp --}}
                                <td class="">
                                    {{ $price->unit->name }}
                                </td>
                                <td class="">
                                    {{  floor($price->conversion->conversion_factor) }}
                                </td>
                                <td class="">
                                    {{ ($price->alocation->quantity * $product->index / $price->conversion->conversion_factor) }}
                                </td>
                                <td class="">Rp. {{ number_format($price->cost_price, 2, '.', ',') }}</td>
                                <td class="">Rp. {{ number_format($price->selling_price, 2, '.', ',') }}</td>
                                <td class="">
                                    <x-badge color="{{ $price->sell_online == 1 ? 'success' : 'danger' }}"  label="{{ $price->sell_online == 1 ? 'Ya' : 'Tidak' }}" />
                                </td>
                                <td class="">
                                    <x-badge color="{{ $price->sell_online == 1 ? 'success' : 'danger' }}"  label="{{ $price->sell_online == 1 ? 'Aktif' : 'Inactive' }}" />
                                </td>
                                {{-- <td class=""><x-form.toggle name="conversion_status{{ $index }}"
                                        id="conversion_status{{ $index }}"
                                        wire:change="handleStatusConversion({{ $price->id }})"
                                        wire:model.live="statuses.{{ $price->id }}"
                                        wire:key="status-{{ $price->id }}" :disabled="$price->product_unit_id == $product->base_unit_id ||
                                            $price->product_unit_id == $product->base_warehouse_unit_id" /></td> --}}
                                <td class="text-right">
                                    <x-button.button-icon color="danger" title="Hapus" name="" :disabled="$price->product_unit_id == $product->base_unit_id ||
                                        $price->product_unit_id == $product->base_warehouse_unit_id"
                                        wire:click="deleteConversion({{ $price->id }})"
                                        wire:loading.attr="disabled">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" class="size-4 stroke-white stroke-[3px]">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </x-button.button-icon>
                                </td>
                            </tr>
                            @endif
                        @endforeach

                    </x-slot>
                </x-table>
            </div>
        </x-card-basic>
    @endforeach

</div>
