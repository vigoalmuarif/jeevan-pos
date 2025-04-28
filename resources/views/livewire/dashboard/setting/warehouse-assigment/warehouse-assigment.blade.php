<div>
    <x-admin.heading class="mb-5 pb-3" back="dashboards.inventories.stock_managements.kartu_stock_gudang.index">
        Distribusi Gudang
    </x-admin.heading>

    @php
        $tableLoading = ['warehouse_filter'];
    @endphp

    <div class="action flex justify-start mb-5">
        <button type="button" class="btnPrimary" id="btnOpenmodalWarehouseAssigment">
            Tambah
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="size-4 inline-flex stroke-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
        </button>
    </div>
    {{-- result alocations --}}
    <div class="flex flex-col space-y-5">
        @foreach ($warehouses as $item)
            <x-card-basic class="rounded-t-xl px-3">
                <div class="flex flex-col">
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="p-1.5 min-w-full inline-block align-middle">
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                    <caption
                                        class="py-2 text-start text-base font-semibold text-gray-600 dark:text-neutral-200">
                                      {{ $item->warehouse_code }} - {{ $item->name }}
                                    </caption>
                                    <thead>
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                                #</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                                Kode</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                                Cabang</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                                Phone</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                                Alamat</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                                Status</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                        @forelse ($item->branches as $index => $branch)
                                            <tr>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                    {{ $index + 1 }}</td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                                    {{ $branch->warehouse_code }}</td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                                    {{ $branch->name }}</td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                                    {{ $branch->phone }}</td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200" title="{{ $branch->address }}">
                                                    {{ str()->limit($branch->address, 30 , '....') }}</td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                                    @if($branch->pivot->status == 1) <x-badge color='success' label='Aktif' /> @else <x-badge color='danger' label='Tidak Aktif' /> @endif</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                                    <x-button type="submit" class="btnPrimary me-2" wire:click="edit({{ $branch->pivot->id }})" wire:target="edit({{ $branch->pivot->id }})">
                                                        <x-slot name="loading" wire:target="edit({{ $branch->pivot->id }})">
                                                            Memuat...
                                                        </x-slot>
                                                        <x-slot name="default" wire:target="edit({{ $branch->pivot->id }})">
                                                            Ubah
                                                        </x-slot>
                                                    </x-button>
                                                    <x-button type="submit" class="btnSecondary bg-rose-600 hover:bg-rose-500 me-2 py-1.5" wire:click="delete({{ $branch->pivot->id }})" wire:target="delete({{ $branch->pivot->id }})">
                                                        <x-slot name="loading" wire:target="delete({{ $branch->pivot->id }})">
                                                            Memuat...
                                                        </x-slot>
                                                        <x-slot name="default" wire:target="delete({{ $branch->pivot->id }})">
                                                            Hapus
                                                        </x-slot>
                                                    </x-button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="1000" class="h-40">
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
                        </div>
                    </div>
                </div>
            </x-card-basic>
        @endforeach
    </div>
    <livewire:dashboard.setting.warehouse-assigment.create-warehouse-assigment/>
    <livewire:dashboard.setting.warehouse-assigment.edit-warehouse-assigment/>
    
</div>
@script
<script>
            $wire.on('openModalEdit', function(e) {
            const modalEditWarehouseAssigment = new HSOverlay(document.querySelector('#modalEditWarehouseAssigment'));
            modalEditWarehouseAssigment.open();
        })

</script>
@endscript