<div>

    <form wire:submit.prevent="save">
        <x-modal title="Detail Pengiriman">
            <div>
                <x-card-basic
                    class="py-5 w-full bg-slate-100 dark:bg-slate-800 dark:border-transparent border-transparent px-4 md:col-span-6 mb-8">
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-6">

                        <div class="flex flex-row items-center">
                            <div class="flex-shrink-0 me-2.5 bg-primary-200/70 rounded-xl dark:bg-primary-700/20 p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6 stroke-primary-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-slate-400">No Pengiriman</p>
                                <p class="text-sm font-medium text-slate-700 dark:text-slate-300">
                                    {{ $delivery->delivery_number }}</p>
                            </div>
                        </div>

                        <div class="flex flex-row items-center">
                            <div class="flex-shrink-0 me-2.5 bg-primary-200/70 rounded-xl dark:bg-primary-700/20 p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6 stroke-primary-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-slate-400">No Permintaan</p>
                                <p class="text-sm font-medium text-slate-700 dark:text-slate-300">
                                    {{ $delivery->requestOrder->no_order }}</p>
                            </div>
                        </div>

                        <div class="flex flex-row items-center">
                            <div class="flex-shrink-0 me-2.5 bg-primary-200/70 rounded-xl dark:bg-primary-700/20 p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6 stroke-primary-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-slate-400">Tanggal Kirim</p>
                                <p class="text-sm font-medium text-slate-700 dark:text-slate-300">
                                    {{ $delivery->delivery_date ? date('d-m-Y H:i', strtotime($delivery->delivery_date)) : '-' }}
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-row items-center">
                            <div class="flex-shrink-0 me-2.5 bg-primary-200/70 rounded-xl dark:bg-primary-700/20 p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6 stroke-primary-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-slate-400">Tanggal Sampai</p>
                                <p class="text-sm font-medium text-slate-700 dark:text-slate-300">
                                    {{ $delivery->finish_date ? date('d-m-Y H:i', strtotime($delivery->finish_at)) : '-' }}
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-row items-center">
                            <div class="flex-shrink-0 me-2.5 bg-primary-200/70 rounded-xl dark:bg-primary-700/20 p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6 stroke-primary-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-slate-400">Driver</p>
                                <p class="text-sm font-medium text-slate-700 dark:text-slate-300">
                                    {{ $delivery->user?->username ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="flex flex-row items-center">
                            <div class="flex-shrink-0 me-2.5 bg-primary-200/70 rounded-xl dark:bg-primary-700/20 p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6 stroke-primary-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-slate-400">Status</p>
                                <p class="text-sm font-medium text-slate-700 dark:text-slate-300">
                                    @if ($delivery->status == 'New')
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-gray-50 text-gray-500 dark:bg-white/10 dark:text-white">Baru</span>
                                    @elseif ($delivery->status == 'delivery')
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-800/30 dark:text-amber-500">Dalam
                                            Pengiriman</span>
                                    @elseif ($delivery->status == 'received')
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-300">Telah
                                            Sampai</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-row items-center">
                            <div class="flex-shrink-0 me-2.5 bg-primary-200/70 rounded-xl dark:bg-primary-700/20 p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6 stroke-primary-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-slate-400">Catatan</p>
                                <p class="text-sm font-medium text-slate-700 dark:text-slate-300">
                                    {{ $delivery->note ?? '-' }}</p>
                            </div>
                        </div>

                    </div>
                </x-card-basic>
                <x-card-basic class="overflow-x-auto scrollbar-thin">
                    <div class="overflow-y-auto max-h-[40vh] scrollbar-thin" id="wrapperTable">
                        <table class="min-w-full divide-y table-auto divide-gray-200 dark:divide-neutral-700"
                            id="table">
                            <thead>
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 whitespace-nowrap text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500 rounded-s-xl">
                                        No</th>
                                    <th scope="col"
                                        class="px-6 py-3 whitespace-nowrap  text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                        Produk</th>
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
                                        class="px-6 py-3 whitespace-nowrap  text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                        Qty Kirim</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-300 dark:divide-neutral-700">
                                @php
                                    $no = 1;
                                @endphp
                                @forelse ($items as $index => $item)
                                    <tr class="group" wire:key="request-order-delivery-item-{{ $item->id }}">
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                            {{ $no++ }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200"
                                            title="{{ $item->product->name }}">
                                            {{ str()->limit($item->product->name, 30, '.....') }} </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{ $item->unit->name }} </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm  text-gray-800 dark:text-neutral-200">
                                            {{ number_format($item->qty_requested, 2) }}</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200 tracking-widest">
                                            {{ number_format($item->total_qty_approved, 2) }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200 tracking-widest">
                                            {{ number_format($item->qty_delivered, 2) }}
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

            <x-slot name="footer">
                <x-button class="btnSecondary" wire:click="$dispatch('closeModal')">
                    Tutup
                </x-button>
                <x-button type="submit" class="btnPrimary" wire:target="save">
                    <x-slot name="loading" wire:target="save">
                        Memproses
                    </x-slot>
                    <x-slot name="default" wire:target="save">
                        Simpan
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-4 inline-flex">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                        </svg>

                    </x-slot>
                </x-button>
            </x-slot>
        </x-modal>
    </form>
</div>
@script
    <script>
        $('.js-example-basic-multiple').select2({
            placeholder: "Pilih Role",
        });
        document.addEventListener('livewire:update', function() {
            // Re-inisialisasi Select2 setelah Livewire update konten
            $('.js-example-basic-multiple').select2({
                placeholder: "Pilih Role",
            });
        });
    </script>
@endscript
