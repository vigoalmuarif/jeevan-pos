<div>
    <div class="flex items-center space-x-3 w-full mb-5">
        <x-card-basic class="p-2.5 w-full">
            <form wire:submit="addAlocation">
                <div class="grid grid-cols-2  md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 pb-2">
                    <div class="">
                        <x-form.label for="templateAlokasiUnit">Warehouse / Branch</x-form.label>
                        <x-form.select-search id="templateAlokasiUnit" name="templateAlokasiUnit"
                            wire:model="templateAlokasiUnit" placeholder="Pilih unit">
                            <option value="">Pilih Unit</option>
                            @foreach ($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}" wire:key="warehouse-{{ $warehouse->id }}"
                                    @if ($warehouse->id == $templateAlokasiUnit) selected @endif
                                    {{ in_array($warehouse->id, $is_alocations) ? 'disabled' : '' }}>
                                    {{ $warehouse->name }}
                                    {{ in_array($warehouse->id, $is_alocations) ? ' - Sudah Dialokasi' : '' }}
                                </option>
                            @endforeach
                        </x-form.select-search>
                    </div>
                    <div class="">
                        <x-form.label for="templateAlokasiSatuan">Satuan Besar</x-form.label>
                        <x-form.select-search id="templateAlokasiSatuan" name="templateAlokasiSatuan"
                            wire:model="templateAlokasiSatuan" placeholder="Pilih satuan">
                            <option value="">Pilih Satuan</option>
                            @foreach (collect($unitConversions)->unique('product_unit_id') as $unit)
                                <option value="{{ $unit->unit->id }}" wire:key="unit-alokasi-{{ $unit->id }}"
                                    @if ($unit->unit->id == $templateAlokasiSatuan) selected @endif>
                                    {{ $unit->unit->name }}
                                </option>
                            @endforeach
                        </x-form.select-search>
                    </div>
                    <div>
                        <div>
                            <x-form.label for="templateQtyAwal">Stok Awal</x-form.label>
                            <div class="relative">
                                <input type="text"
                                class="w-full @if ($errors->has('templateQtyAwal')) isInvalid @else formInput @endif rounded-s-xl"
                                step="any" oninput="this.value = this.value.replace(/[^0-9.]/g, '')"
                                id="templateQtyAwal" name="templateQtyAwal" wire:model="templateQtyAwal"
                                autocomplete="off">
                                <div class="absolute inset-y-0 end-0 flex items-center text-slate-500 dark:text-slate-400 pointer-events-none z-20 pe-4">
                                    {{ $product->base_unit->name }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <x-form.label for="templateQtyMinimal">Quantity Minimal</x-form.label>
                        <input type="number"
                            class="w-full @if ($errors->has('templateQtyMinimal')) isInvalid @else formInput @endif"
                            step="any" oninput="this.value = this.value.replace(/[^0-9.]/g, '')"
                            id="templateQtyMinimal" name="templateQtyMinimal" wire:model="templateQtyMinimal"
                            autocomplete="off" />
                    </div>
                    <div>
                        <x-form.label for="templateQtyMaximal">Quantity Maksimal</x-form.label>
                        <input type="number"
                            class="w-full @if ($errors->has('templateQtyMaximal')) isInvalid @else formInput @endif"
                            step="any" oninput="this.value = this.value.replace(/[^0-9.]/g, '')"
                            id="templateQtyMaximal" name="templateQtyMaximal" wire:model="templateQtyMaximal"
                            autocomplete="off" />
                        @error('templateQtyMaximal')
                            <p class="isInvalidMessage" id="error-msg-{{ $templateQtyMaximal }}">
                                {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="">
                        <x-form.label for="templateAlokasiStatus">Status</x-form.label>
                        <div class="flex items-center w-full">
                            <div class="w-full me-2">
                                <x-form.select-search id="status" name="templateAlokasiStatus"
                                    wire:model="templateAlokasiStatus" placeholder="Pilih status">
                                    <option value="" {{ $templateAlokasiStatus == '' ? 'selected' : '' }}>Pilih
                                        Status</option>
                                    <option value="1" {{ $templateAlokasiStatus == '1' ? 'selected' : '' }}>Aktif
                                        Unit</option>
                                    <option value="2" {{ $templateAlokasiStatus == '2' ? 'selected' : '' }}>Aktif
                                        Penjualan</option>
                                    <option value="3" {{ $templateAlokasiStatus == '3' ? 'selected' : '' }}>Aktif
                                        Unit & Aktif Penjualan</option>
                                    <option value="0" {{ $templateAlokasiStatus == '0' ? 'selected' : '' }}>Tidak
                                        Aktif</option>
                                </x-form.select-search>
                            </div>
                            <div class="hidden lg:block">
                                <x-button.button-icon type="submit" color="primary" title="Tambah" name=""
                                    wire:target="addAlocation" wire:loading.attr="disabled">
                                    <x-utility.loading.spiner class="w-5 h-5" wire:loading wire:target="addAlocation" />
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" class="size-5 stroke-white stroke-[3px]"
                                        wire:loading.remove wire:target="addAlocation">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>

                                </x-button.button-icon>
                            </div>
                        </div>
                        {{-- @error($templateQtyUnit)
                    <p class="isInvalidMessage" id="error-msg-{{ $templateQtyUnit }}">
                        {{ $message }}</p>
                        @enderror --}}
                    </div>
                </div>
                <div class="w-full mt-7 lg:hidden col-span-6">
                    <x-button type="submit" class="btnPrimary w-full" wire:target="addAlocation">
                        <x-slot:loading wire:target="addAlocation">
                            Menyimpan...
                        </x-slot:loading>
                        <x-slot:default wire:target="addAlocation">
                            Tambah
                        </x-slot:default>
                    </x-button>

                </div>
            </form>
        </x-card-basic>
    </div>

    {{-- result alocations --}}
    <x-card-basic class="rounded-t-xl">
        <div class="relative">
            <x-table count="{{ $alocations->count() }}">
                <x-slot:action>

                </x-slot>
                <x-slot name="heading">
                    <tr>
                        <th scope="col" class="">Unit</th>
                        <th scope="col" class="">Qty Unit</th>
                        <th scope="col" class="">Satuan</th>
                        <th scope="col" class="">Qty Min</th>
                        <th scope="col" class="">Qty Max</th>
                        <th scope="col" class="">Status</th>
                        <th scope="col" class="text-right">Action</th>
                    </tr>
                </x-slot>
                <x-slot name="body">
                    @foreach ($alocations as $index => $alocation)
                        <tr class="hover:bg-slate-200 dark:hover:bg-slate-800" wire:key="{{ $alocation->id }}">
                            <td class="">{{ $alocation->warehouse->name }}</td>
                            <td class="">{{ $alocation->quantity }}</td>
                            <td class="">{{ $alocation->unit->name }}</td>
                            <td class="">{{ $alocation->minimal_stock }}</td>
                            <td class="">{{ $alocation->maximal_stock }}</td>
                            <td class="">
                                <x-form.select id="status" name="" class="w-60"
                                    placeholder="Pilih status">
                                    <option value="" {{ $alocation->status == '' ? 'selected' : '' }}>Pilih
                                        Status</option>
                                    <option value="1" {{ $alocation->status == '1' ? 'selected' : '' }}>Aktif
                                        Unit</option>
                                    <option value="2" {{ $alocation->status == '2' ? 'selected' : '' }}>Aktif
                                        Penjualan</option>
                                    <option value="3" {{ $alocation->status == '3' ? 'selected' : '' }}>Aktif
                                        Unit & Aktif Penjualan</option>
                                    <option value="0" {{ $alocation->status == '0' ? 'selected' : '' }}>Tidak
                                        Aktif</option>
                                </x-form.select>
                            </td>

                            {{-- <td class=""><x-form.toggle name="alocation_status{{ $index }}"
                                    id="alocation_status{{ $index }}"
                                    wire:change="handleStatusalocation({{ $alocation->id }})"
                                    wire:model.live="statuses.{{ $alocation->id }}"
                                    wire:key="status-{{ $alocation->id }}" />
                            </td> --}}
                            <td class="text-right">
                                <x-button.button-icon color="danger" title="Hapus" name=""
                                    wire:click="deletealocation({{ $alocation->id }})" wire:loading.attr="disabled">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" class="size-4 stroke-white stroke-[3px]">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </x-button.button-icon>
                            </td>
                        </tr>
                    @endforeach

                </x-slot>
            </x-table>
        </div>
    </x-card-basic>
</div>
