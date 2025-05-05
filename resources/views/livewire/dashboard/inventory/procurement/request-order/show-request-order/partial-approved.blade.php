<div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
    <div>
        <h6 class="text-base mb-3 font-medium text-slate-600 dark:text-slate-300">Item</h6>
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
                                Nama Barang</th>
                            <th scope="col"
                                class="px-6 py-3 whitespace-nowrap  text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Satuan</th>
                            <th scope="col"
                                class="px-6 py-3 whitespace-nowrap  text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Qty Minta</th>
                            <th scope="col"
                                class="px-6 py-3 whitespace-nowrap  text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Qty Approved</th>
                            <th scope="col"
                                class="px-6 py-3 whitespace-nowrap  text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300 dark:divide-neutral-700">
                        @php
                            $no = 1;
                        @endphp
                        @forelse ($requestOrderItems as $index => $item)
                            @php
                                $qty_request = $item['qty_request'];
                                $stockWarehouse = $item['stock_source_warehouse'];
                                $stockUnit = $item['stock_destination_warehouse'];
                                $sisaUnit = floatVal($stockUnit) + floatVal($qty_request);
                                $sisaWarehouse = floatVal($stockWarehouse) - floatVal($qty_request);
                            @endphp
                            <tr class="group" wire:key="product-partial-approved-{{ $item['id'] }}">
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                    {{ $no++ }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200" title="{{ $item['product']['name'] }}">
                                    {{ str()->limit('[' .$item['product']['sku'] . ']' . ' ' .  $item['product']['name'], 30 , '.....') }} </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm  text-gray-800 dark:text-neutral-200">
                                    {{ $item['satuan_request'] }}</td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200 tracking-widest">
                                    {{ number_format($item['qty_request'], 2) }}</td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200 tracking-widest">
                                    {{ number_format($item['qtyApproved'], 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                    <x-button type="button" class="btnPrimary py-1.5"
                                        wire:click="added('{{ $item['id'] }}', '{{ $item['product']['id'] }}')" wire:key="added-{{ $item['id'] }}">
                                        <x-slot name="loading" wire:target="added('{{ $item['id'] }}', '{{ $item['product']['id'] }}')">
                                            Pilih
                                        </x-slot>
                                        <x-slot name="default" wire:target="added('{{ $item['id'] }}', '{{ $item['product']['id'] }}')">
                                            Pilih
                                        </x-slot>
                                    </x-button>

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
            <p class="pl-4">Total : {{ count($requestOrderItems) }} Items</p>
            <div>
                <x-button type="submit" class="btnPrimary py-2.5" wire:target="selectAll()" :disabled="count($requestOrderItems) == 0 ? true : false">
                    <x-slot name="loading" wire:target="selectAll()">
                        Memproses...
                    </x-slot>
                    <x-slot name="default" wire:target="selectAll()">
                        Pilih Semua
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-5 ms-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                        </svg>

                    </x-slot>
                </x-button>
            </div>
        </div>
    </div>
    <div>
        <h6 class="text-base mb-3 font-medium text-slate-600 dark:text-slate-300">Proses</h6>
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
                                Nama Barang</th>
                            <th scope="col"
                                class="px-6 py-3 whitespace-nowrap  text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Satuan</th>
                            <th scope="col"
                                class="px-6 py-3 whitespace-nowrap  text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Kekurangan</th>
                            <th scope="col"
                                class="px-6 py-3 whitespace-nowrap  text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Qty Approved</th>
                            <th scope="col"
                                class="px-6 py-3 whitespace-nowrap  text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300 dark:divide-neutral-700">
                        @php
                            $no = 1;
                        @endphp
                        @forelse ($items as $index => $item)
                            <tr class="group" wire:key="product-proccess-partial-approved-{{ $item['id'] }}">
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                    {{ $no++ }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200" title="{{ $item['product']['name'] }}">
                                    {{ str()->limit('[' .$item['product']['sku'] . ']' . ' ' .  $item['product']['name'], 30 , '.....') }} </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm  text-gray-800 dark:text-neutral-200">
                                    {{ $item['satuan'] }}</td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200 tracking-widest">
                                    {{ number_format($item['kekurangan'], 2) }}</td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap max-w-28 text-sm text-gray-800 dark:text-neutral-200 tracking-widest">
                                    <x-form.input
                                        class="text-slate-700 dark:text-slate-200 disabled:text-slate-500 disabled:dark:text-slate-300 group-hover:border-primary-500 group-hover:dark:border-primary-500  group-hover:disabled:dark:border-transparent"
                                        wire:model.debounce.700ms="items.{{ $index }}.qty_approved"
                                        wire:keyup.debounce.700ms="validasiQtyApproved({{ $index }})"
                                        onclick="this.select()" type="text"
                                        disabled="{{ $item['status'] == 'rejected' && ($item['status'] != 'requested' || $item['status'] != 'reviewed') ? true : false }}" />
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                    <button type="button" class="px-4 py-1 text-white bg-rose-600 rounded-xl"
                                    wire:target="cancel({{ $item['id'] }})" wire:loading.attr="disabled"
                                    wire:click="cancel({{ $item['id'] }})">
                                    Batal
                                </button>

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
            <p class="pl-4">Total : {{ count($requestOrderItems) }} Items</p>
            <div>
                <x-button type="submit" class="btnPrimary py-2.5" wire:target="save, reject"
                :disabled="count($items) == 0 ? true : false">
                <x-slot name="loading" wire:target="save()">
                    Memproses...
                </x-slot>
                <x-slot name="default" wire:target="save()">
                    Approve
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-5 ms-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                    </svg>

                </x-slot>
            </x-button>
            </div>
        </div>
    </div>

</div>
