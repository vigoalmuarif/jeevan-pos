<div>
    <form action="" wire:submit="save()">
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
                            <th scope="col"
                                class="px-6 py-3 whitespace-nowrap  text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Qty Approved</th>
                            @if($requestOrder->status == 'requested' || $requestOrder->status == 'reviewed')
                                <th scope="col"
                                    class="px-6 py-3 whitespace-nowrap  text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Stok Unit</th>
                                <th scope="col"
                                    class="px-6 py-3 whitespace-nowrap  text-start text-xsfont-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Stok Gudang</th>
                            @endif
                            <th scope="col"
                                class="px-6 py-3 whitespace-nowrap  text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Catatan</th>
                            <th scope="col"
                                class="px-6 py-3 whitespace-nowrap  text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Status</th>
                            @if($requestOrder->status == 'requested' || $requestOrder->status == 'reviewed')
                                <th scope="col"
                                    class="px-6 py-3 whitespace-nowrap  text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Action</th>
                            @endif
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
                                    {{ $item['satuan_request'] }}</td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200 tracking-widest">
                                    {{ number_format($item['qty_request'], 2) }}</td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap max-w-28 text-sm text-gray-800 dark:text-neutral-200 tracking-widest">
                                    <x-form.input
                                        class="text-slate-700 dark:text-slate-200 disabled:text-slate-500 disabled:dark:text-slate-300 group-hover:border-primary-500 group-hover:dark:border-primary-500  group-hover:disabled:dark:border-transparent"
                                        wire:model.debounce.700ms="requestOrderItems.{{ $index }}.qtyApproved"
                                        wire:keyup.debounce.700ms="validasiQtyApproved({{ $index }})"
                                        onclick="this.select()" type="text"
                                        disabled="{{ $item['status'] == 'rejected' || $requestOrder->status == 'approved' || $requestOrder->status == 'partial_approved' || $requestOrder->status == 'rejected' ? true : false }}" />
                                </td>
                                @if($requestOrder->status == 'requested' || $requestOrder->status == 'reviewed')
                                <td
                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200 tracking-widest">
                                {{ number_format($stockUnit, 2) }}</td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-neutral-200 tracking-widest">
                                    {{ number_format($stockWarehouse, 2) }}
                                </td>
                                @endif
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                    <p class="{{ $item['reject_reason'] ? 'text-xs': '' }}">
                                        {{ $item['reject_reason'] ? 'Peminta :' :  '' }} {{ $item['note'] }}
                                    </p>
                                    <p class="{{ $item['reject_reason'] ? 'text-xs': '' }}">
                                        {{ $item['reject_reason'] ? 'Alasan Tolak :' : '' }} {{ $item['reject_reason'] }}
                                    </p>
                                </td>
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
                                @if($requestOrder->status == 'requested' || $requestOrder->status == 'reviewed')
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
                                                    wire:target="reject({{ $index }})" wire:loading.attr="disabled"
                                                    wire:click="reject({{ $index }})">
                                                    {{ $item['status'] == 'rejected' ? 'Batal Tolak' : 'Tolak' }}
                                                </button>
                                                {{-- default --}}
                                            @else
                                                <button type="button" class="px-4 py-1 text-white bg-rose-600 rounded-xl"
                                                    wire:target="reject({{ $index }})" wire:loading.attr="disabled"
                                                    wire:click="reject({{ $index }})">
                                                    {{ $item['status'] == 'rejected' ? 'Batal Tolak' : 'Tolak' }}
                                                </button>
                                            @endif
                                        @endif


                                    </td>
                                @endif
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
                    {{-- @if (($requestOrder->status == 'partial_approved' || $requestOrder->status == 'approved') && $requestOrder->status != 'rejected')
                        <x-button type="submit" class="btnPrimary py-2.5" wire:target="save()" :disabled="count($requestOrderItems) == 0 ? true : false">
                            <x-slot name="loading" wire:target="save()">
                                Memproses...
                            </x-slot>
                            <x-slot name="default" wire:target="save()">
                                Update
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-5 ms-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                </svg>

                            </x-slot>
                        </x-button>
                    @endif --}}
                    @if (
                        ($requestOrder->status == 'requested' || $requestOrder->status == 'reviewed') &&
                            $requestOrder->status != 'rejected')
                        <x-button type="submit" class="btnPrimary py-2.5" wire:target="save, reject" :disabled="count($requestOrderItems) == 0 ? true : false">
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
