<div>
    <x-admin.heading class="pb-5">
        Daftar {{ $type == 'inbound_requests' ? 'Permintaan Masuk' : 'Permintaan Keluar' }}
    </x-admin.heading>

    @php
        $tableLoading = ['warehouse_filter'];
    @endphp
    {{-- result alocations --}}
    <x-card-basic class="rounded-t-xl">
        <div class="relative">
            <x-table count="{{ count($orders) }}">
                <x-slot:action>
                    {{-- <x-button type="button" id="handleBtnAdd" class="btnPrimary py-2.5" wire:target="create()"
                        :disabled="count($listProducts) == 0 ? true : false">
                        <x-slot name="loading" wire:target="create()">
                            Memproses...
                        </x-slot>
                        <x-slot name="default" wire:target="create()">
                            Buat Permintaan
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-5 ms-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                            </svg>

                        </x-slot>
                    </x-button> --}}
                    @if ($type == 'inbound_requests')
                        <a href="{{ route('dashboards.inventories.procurements.request_orders.inbound_requests.create') }}"
                            class="btnPrimary" wire:navigate>
                            Buat Permintaan
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-4 stroke-2">
                                <path fill-rule="evenodd"
                                    d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif
                </x-slot>
                <x-slot name="heading">
                    <tr>
                        <th scope="col" class="">#</th>
                        <th scope="col" class="">No Transaksi</th>
                        <th scope="col" class="">Tgl Permintaan</th>
                        @if ($type == 'inbound_requests')
                            <th scope="col" class="">Unit Pengirim</th>
                        @else
                            <th scope="col" class="">Unit Peminta</th>
                        @endif
                        <th scope="col" class="">Item</th>
                        <th scope="col" class="">Status</th>
                        <th scope="col" class="text-right">Action</th>
                    </tr>
                </x-slot>
                <x-slot name="body">
                    @foreach ($orders as $order)
                        <tr>
                            <td class="w-14">
                                {{ ($orders->currentPage() - 1) * $orders->perPage() + $loop->iteration }}
                            </td>
                            <td class="">{{ $order->no_order }}</td>
                            <td class="">{{ date('d-m-Y H:i', strtotime($order->created_at)) }}</td>
                            @if ($type == 'inbound_requests')
                                <td class="">{{ $order->to_warehouse->name }}</td>
                            @else
                                <td class="">{{ $order->from_warehouse->name }}</td>
                            @endif
                            <td class="">{{ $order->items_count }}</td>
                            <td class="">
                                @if ($order->status == 'draft')
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-gray-50 text-gray-500 dark:bg-white/10 dark:text-white">Draft</span>
                                @elseif ($order->status == 'requested')
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-white/10 dark:text-white">Requested</span>
                                @elseif ($order->status == 'reviewed')
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-sky-100 text-sky-800 dark:bg-sky-800/30 dark:text-sky-500">Reviewed</span>
                                @elseif ($order->status == 'approved')
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-teal-100 text-teal-800 dark:bg-teal-800/30 dark:text-teal-500">Approved</span>
                                @elseif ($order->status == 'partial_approved')
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-800/30 dark:text-amber-500">Partial
                                        Approved</span>
                                @elseif ($order->status == 'ready_to_send')
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-800/30 dark:text-indigo-500">Ready
                                        to Send</span>
                                @elseif ($order->status == 'shipped')
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-800/30 dark:text-purple-500">Shipped</span>
                                @elseif ($order->status == 'received')
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-lime-100 text-lime-800 dark:bg-lime-800/30 dark:text-lime-500">Recevied</span>
                                @elseif ($order->status == 'completed')
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-500">Completed</span>
                                @elseif ($order->status == 'rejected')
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-rose-100 text-rose-800 dark:bg-rose-800/30 dark:text-rose-500">Rejected</span>
                                @elseif ($order->status == 'cancelled')
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-500">Cancelled</span>
                                @endif
                            </td>
                            <td class="text-right">
                                @if ($type == 'outbound_requests')
                                    <a href="{{ route('dashboards.inventories.procurements.request_orders.outbound_requests.show', $order->no_order) }}"
                                        class="btnPrimary py-1.5" wire:navigate>
                                        Detail
                                    </a>
                                @else
                                    <a href="{{ route('dashboards.inventories.procurements.request_orders.inbound_requests.show', $order->no_order) }}"
                                        class="btnPrimary py-1.5" wire:navigate>
                                        Detail
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </x-slot>
                <x-slot:paginate>
                    {{ $orders->links(data: ['scrollTo' => false]) }}
                </x-slot:paginate>
            </x-table>
        </div>
    </x-card-basic>
</div>
