<div>
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
                            No Pengiriman</th>
                        <th scope="col"
                            class="px-6 py-3 whitespace-nowrap  text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                            No Permintaan</th>
                        <th scope="col"
                            class="px-6 py-3 whitespace-nowrap  text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                            User Delivery</th>
                        <th scope="col"
                            class="px-6 py-3 whitespace-nowrap  text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                            Tanggal Kirim</th>
                        <th scope="col"
                            class="px-6 py-3 whitespace-nowrap  text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                            Tanggal Sampai</th>
                        <th scope="col"
                            class="px-6 py-3 whitespace-nowrap  text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                            Note</th>
                        <th scope="col"
                            class="px-6 py-3 whitespace-nowrap  text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                            Status</th>
                        <th scope="col"
                            class="px-6 py-3 whitespace-nowrap  text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                            Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300 dark:divide-neutral-700">
                    @php
                        $no = 1;
                    @endphp
                    @forelse ($deliveries as $index => $item)
                        <tr class="group" wire:key="request-order-delivery-{{ $item->id }}">
                            <td
                                class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                {{ $no++ }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200"
                                title="{{ $item->delivery_number }}">
                                {{ $item->delivery_number }} </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200"
                                title="{{ $item->delivery_number }}">
                                {{ $item->requestOrder->no_order }} </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm  text-gray-800 dark:text-neutral-200">
                                {{ $item->user?->username ?: '-' }}</td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200 tracking-widest">
                                {{ $item->delivery_date ? date('d-m-Y H:i', strtotime($item->delivery_date)) : '-' }}
                            </td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200 tracking-widest">
                                {{ $item->finish_date ? date('d-m-Y H:i', strtotime($item->finish_date)) : '-' }}</td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200 tracking-widest">
                                {{ $item->note ?: '-' }}</td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200 tracking-widest">
                                @if ($item->status == 'New')
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-gray-50 text-gray-500 dark:bg-white/10 dark:text-white">Baru</span>
                                    @elseif ($item->status == 'delivery')
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-800/30 dark:text-amber-500">Dalam Pengiriman</span>
                                    @elseif ($item->status == 'received')
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-300">Telah Sampai</span>
                                    @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                <x-button type="button" class="btnPrimary py-1.5"
                                    wire:click="detail('{{ $item->id }}')">
                                    <x-slot name="loading"
                                        wire:target="detail('{{ $item->id }}')">
                                        Memuat ...
                                    </x-slot>
                                    <x-slot name="default"
                                        wire:target="detail('{{ $item->id }}')">
                                        Detail
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
</div>
