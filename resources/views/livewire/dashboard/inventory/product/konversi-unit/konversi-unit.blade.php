<div>
    {{-- <div class="grid grid-cols-2 gap-4">
        <div class="">
            <x-form.label for="selectedSatuanTerkecil">Satuan Terkecil</x-form.label>
            <x-form.select-search id="selectedSatuanTerkecil" name="form.unit_id" wire:model="form.unit_id">
                <option value="0">Satuan Terkecil</option>
                @foreach ($units as $unit)
                    <option value="{{ $unit->id }}" wire:key="unit-{{ $unit->id }}">
                        {{ $unit->name }}
                    </option>
                @endforeach
            </x-form.select-search>
        </div>
        <div class="">
            <x-form.label for="quantitySatuanTerkecil">Quantity</x-form.label>
            <x-form.input class="border-transparent" id="name" name="form.name" wire:model="form.name" />
        </div>

    </div> --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
        <div class="lg:col-span-4">
            <div class="flex items-center space-x-3 w-full ">
                <x-card-basic class="p-2.5 w-full">
                    <form wire:submit="addConversion" class="w-full">
                        <div class="grid grid-cols-2 gap-4 pb-2">
                            <div class="">
                                <x-form.label for="templateConversionFromUnit">Satuan</x-form.label>
                                <x-form.select-search id="templateConversionFromUnit" name="templateConversionFromUnit"
                                    wire:model="templateConversionFromUnit">
                                    <option value="0">Pilih Satuan</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}" wire:key="unit-{{ $unit->id }}"
                                            @if ($unit->id == $templateConversionFromUnit) selected @endif>
                                            {{ $unit->name }}
                                        </option>
                                    @endforeach
                                </x-form.select-search>
                            </div>
                            <div class="">
                                <div class="w-full space-y-3">
                                    <div>
                                        <x-form.label for="templateConversionFactor">Quantity</x-form.label>
                                        <div class="relative">
                                            <input type="text" id="hs-trailing-icon" name="hs-trailing-icon"
                                                class="w-full @if ($errors->has('templateConversionFactor')) isInvalid @else formInput @endif"
                                                placeholder="qty"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '')"
                                                id="templateConversionFactor" name="templateConversionFactor"
                                                wire:model="templateConversionFactor" autocomplete="off">
                                            <div
                                                class="absolute inset-y-0 end-0 flex items-center text-slate-500 dark:text-slate-400 pointer-events-none z-20 pe-4">
                                                {{ $product->base_unit->name }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @error($templateConversionFactor)
                                    <p class="isInvalidMessage" id="error-msg-{{ $templateConversionFactor }}">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-span-2">
                                <x-button type="submit" class="btnPrimary w-full" wire:target="addConversion">
                                    <x-slot:loading wire:target="addConversion">
                                        Menyimpan...
                                    </x-slot:loading>
                                    <x-slot:default wire:target="addConversion">
                                        Tambah
                                    </x-slot:default>
                                </x-button>
                            </div>
                        </div>
                    </form>
                </x-card-basic>
            </div>
        </div>
        {{-- result conversions --}}
        <x-card-basic class="rounded-t-xl lg:col-span-8">
            <div class="relative">
                <x-table count="{{ $unitConversions->count() }}" :perPage="false" :search="false"
                    rounded_top="rounded-t-xl">
                    <x-slot:action>

                    </x-slot>
                    <x-slot name="heading">
                        <tr>
                            <th scope="col" class="">Satuan</th>
                            <th scope="col" class="">Qty</th>
                            <th scope="col" class="">Aktif</th>
                            <th scope="col" class="text-right">Action</th>
                        </tr>
                    </x-slot>
                    <x-slot name="body">
                        @foreach (collect($unitConversions)->unique('product_unit_id') as $index => $conversion)
                            <tr class="hover:bg-slate-200 dark:hover:bg-slate-800" wire:key="{{ $conversion->id }}">
                                @php
                                    $base_unit = $product->base_unit_id == $conversion->product_unit_id ? $index : '';
                                @endphp
                                <td class="">
                                        {{ $conversion->unit->name }}
                                        {{ $conversion->product_unit_id == $product->base_unit_id ? '- Satuan kecil' : '' }}
                                        {{ $conversion->product_unit_id == $product->base_warehouse_unit_id ? '- Satuan besar' : '' }}
                                </td>
                                <td class="">{{ number_format($conversion->conversion_factor, 0, '.', ',') }}
                                    <span class="text-slate-500">{{ $product->base_unit->name }}</span>
                                </td>
                                <td class="">
                                    <x-form.toggle name="conversion_status{{ $index }}"
                                        id="conversion_status{{ $index }}"
                                        wire:change="handleStatusConversion({{ $conversion->id }})"
                                        wire:model.live="statuses.{{ $conversion->id }}"
                                        wire:key="status-{{ $conversion->id }}" :disabled="$conversion->product_unit_id == $product->base_unit_id ||
                                            $conversion->product_unit_id == $product->base_warehouse_unit_id" />
                                </td>
                                <td class="text-right">
                                    <x-button.button-icon color="danger" title="Hapus" name="" :disabled="$conversion->product_unit_id == $product->base_unit_id ||
                                        $conversion->product_unit_id == $product->base_warehouse_unit_id"
                                        wire:click="deleteConversion({{ $conversion->id }})"
                                        wire:loading.attr="disabled">
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
</div>
