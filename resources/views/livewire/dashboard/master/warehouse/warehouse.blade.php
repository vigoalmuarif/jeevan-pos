<div>
    <x-admin.heading class="pb-5">Warehouse & Branch</x-admin.heading>
    <div class="">
        <x-card-basic class="md:col-span-8">
            <div class="relative">
                <x-table count="{{ $warehouses->count() }}">
                    <x-slot:action>
                        <x-button class="btnPrimary" wire:click.prevent="createWarehouse">
                            <x-slot:loading wire:target="createWarehouse">
                                Memuat
                            </x-slot:loading>
                            <x-slot:default wire:target="createWarehouse">
                                Tambah
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                </svg>
                            </x-slot:default>
                        </x-button>
                    </x-slot>
                    <x-slot name="heading">
                        <tr>
                            <th scope="col" class="w-14">No</th>
                            <th scope="col" class="w-20">Kode</th>
                            <th scope="col" class="">Name</th>
                            <th scope="col" class="">Type</th>
                            <th scope="col" class="">phone</th>
                            <th scope="col" class="">Address</th>
                            <th scope="col" class="">status</th>
                            <th scope="col" class="">PIC</th>
                            <th scope="col" class="text-right">Action</th>
                        </tr>
                    </x-slot>
                    <x-slot name="body">
                        @foreach ($warehouses as $index => $warehouse)
                            <tr class="hover:bg-slate-200 dark:hover:bg-slate-800" wire:key="{{ $warehouse->id }}">
                                <td class="w-14">
                                    {{ ($warehouses->currentPage() - 1) * $warehouses->perPage() + $loop->iteration }}</td>
                                <td class="">{{ $warehouse->warehouse_code }}</td>
                                <td class="">{{ $warehouse->name }}</td>
                                <td class="">{{ $warehouse->type }}</td>
                                <td class="">{{ $warehouse->phone }}</td>
                                <td class="">{{ $warehouse->address}}</td>
                                <td class=""><x-badge
                                        color="{{ $warehouse->status == 'Active' ? 'success' : 'danger' }}"
                                        label="{{ $warehouse->status }}" /></td>
                                <td class="">{{ $warehouse->ppic->name }}</td>
                                <td class="">
                                    <div class="flex justify-end space-x-2 5">
                                        <x-button.button-icon color="warning" title="Ubah" name="{{ $warehouse->id }}"
                                            wire:click="editUnit({{ $warehouse->id }})" wire:loading.attr="disabled">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="size-4 stroke-slate-700">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                        </x-button.button-icon>
                                        <x-button.button-icon color="danger" title="delete" name="{{ $warehouse->id }}"
                                            wire:click="deleteUnit({{ $warehouse->id }})" wire:loading.attr="disabled">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="size-4 stroke-slate-700">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>

                                        </x-button.button-icon>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </x-slot>
                </x-table>
            </div>
            <div class="py-4">
                {{ $warehouses->links(data: ['scrollTo' => false]) }}
            </div>
        </x-card-basic>
    </div>

</div>
