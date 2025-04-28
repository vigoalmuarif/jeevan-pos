<div id="modalStockAdjustment"
    class="hs-overlay [--overlay-backdrop:static]  hidden size-full fixed top-0 start-0 z-[9999] overflow-x-hidden overflow-y-auto pointer-events-none"
    role="dialog" tabindex="-1" aria-labelledby="modalStockAdjustment-label" wire:ignore.self>
    <div
        class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all md:max-w-[calc(100vw-18rem)]  w-[calc(100vw-5rem)] m-3 h-[calc(100%-56px)] sm:mx-auto">
        <div
            class="max-h-full overflow-hidden flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-isDark dark:border-neutral-700 dark:shadow-neutral-700/70">
            <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                <h6 id="modalStockAdjustment-label" class="font-bold text-gray-800 dark:text-white">
                    Tambah Penyesuaian Stok
                </h6>
                <button type="button"
                    class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none btn-close dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                    aria-label="Close" onclick="handleCLoseModal()">
                    <span class="sr-only">Close</span>
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="p-4 overflow-y-auto">
                <div class="space-y-4">
                    <div>
                        <form wire:submit.prevent="save" id="formAdjustment">
                            <div>
                                <div class="flex flex-row space-x-3">
                                    <div class="min-w-80">
                                        <x-form.select-search name="Gudang" id="gudang" name="form.warehouse_id"
                                            placeholder="Pilih Gudang/Cabang" label="Gudang/Cabang" required="true"
                                            wire:model.live="warehouseSelected">
                                            <option value=""></option>
                                            @foreach ($warehouses as $warehouse)
                                                <option value="{{ $warehouse->id }}"
                                                    {{ $warehouse->id == $warehouseSelected ? 'selected' : '' }}>
                                                    {{ $warehouse->warehouse_code }} - {{ $warehouse->name }}
                                                </option>
                                            @endforeach
                                        </x-form.select-search>
                                    </div>
                                    <div class="w-44">
                                        <x-form.label id="created_at">Tgl Penyesuaian</x-form.label>
                                        <x-form.input type="date" label="created_at" id="created_at"
                                            name="form.created_at" wire:model="form.created_at"
                                            value="{{ date('Y-m-d') }}" />
                                    </div>
                                </div>
                                <div class="bg-slate-100 dark:bg-isDark px-4 pb-8 rounded-xl mt-7">

                                    <div class="w-full  rounded-xl mt-10">
                                        <div class="-m-1.5 overflow-x-auto">
                                            <div class="p-1.5 min-w-full inline-block align-middle">
                                                <div class="overflow-hidden">
                                                    <table
                                                        class="w-full divide-y table-auto divide-gray-200 dark:divide-neutral-700">
                                                        <thead>
                                                            <tr>
                                                                <th
                                                                    class="px-6 py-3 w-10 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                                                </th>
                                                                <th
                                                                    class="px-6 py-3 min-w-[400px] text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                                                    Produk <span class="text-rose-500 ms-1">*</span>
                                                                </th>
                                                                <th
                                                                    class="px-6 py-3 min-w-40 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                                                    Satuan</th>
                                                                <th
                                                                    class="px-6 py-3 min- w-32 whitespace-nowrap text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                                                    Qty Awal</th>
                                                                <th
                                                                    class="px-6 py-3 w-32 text-start whitespace-nowrap text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                                                    Qty Aktual <span class="text-rose-500 ms-1">*</span>
                                                                </th>
                                                                <th
                                                                    class="px-6 min-w-32 py-3 text-start whitespace-nowrap text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                                                    Selisih</th>
                                                                <th
                                                                    class="px-6 py-3 min-w-80 text-start whitespace-nowrap text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                                                    Alasan <span class="text-rose-500 ms-1">*</span>
                                                                </th>
                                                                <th scope="col"
                                                                    class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                                                    Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                                            <tr>
                                                                <td>#</td>
                                                                <td class="">
                                                                    <div>
                                                                        <label for="productSearch"
                                                                            class="block text-sm font-medium mb-2 dark:text-white sr-only">Produk</label>
                                                                        <select id="productSearch" style="width:100%;">
                                                                            <option value="" wire:key="product-0">
                                                                            </option>
                                                                            @foreach ($fetchProducts as $item)
                                                                                <option value="{{ $item['id'] }}"
                                                                                    {{ in_array($item['id'], array_column($listProducts, 'productID')) ? 'disabled' : '' }}
                                                                                    wire:key="product-{{ $item['id'] }}">
                                                                                    {{ $item['name'] }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td class="">
                                                                    <x-form.select-search name="formUnit" id="formUnit"
                                                                        placeholder="Satuan" label=""
                                                                        readonly="" disabled=""
                                                                        wire:model="formUnit">
                                                                        <option value=""></option>
                                                                        @if ($productSelectedValue)
                                                                            @foreach ($productSelectedValue->product_unit_conversions as $item)
                                                                                <option value="{{ $item->id }}"
                                                                                    {{ $formUnit == $item->id ? 'selected' : '' }}
                                                                                    wire:key="satuan-{{ $item->id }}">
                                                                                    {{ $item->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        @endif
                                                                    </x-form.select-search>
                                                                </td>
                                                                <td class="w-40">
                                                                    <x-form.label id="formQtyAwal" class="sr-only">Qty
                                                                        Awal</x-form.label>
                                                                    <x-form.input type="text" label="Qty Awal"
                                                                        id="formQtyAwal" name="formQtyAwal"
                                                                        class="w-full" wire:model="formQtyAwal"
                                                                        disabled="" readonly="" />
                                                                </td>
                                                                <td>
                                                                    <x-form.label id="formQtyAktual" class="sr-only">Qty
                                                                        Aktual</x-form.label>
                                                                    <x-form.input type="text" label="Qty Aktual"
                                                                        id="formQtyAktual" name="formQtyAktual"
                                                                        wire:model.live.debounce.500ms="formQtyAktual"
                                                                        onclick="this.select()" autocomplete="off" />
                                                                </td>
                                                                <td>
                                                                    <x-form.label id="formQtySelisih"
                                                                        class="sr-only">Selisih</x-form.label>
                                                                    <x-form.input type="text" label="Selisih"
                                                                        id="formQtySelisih" name="formQtySelisih"
                                                                        wire:model="formQtySelisih" disabled=""
                                                                        readonly="" />
                                                                </td>
                                                                <td>
                                                                    <x-form.label id="formReason"
                                                                        class="sr-only">Alasan</x-form.label>
                                                                    <x-form.input type="text" label="alasan"
                                                                        id="formReason" name="formReason"
                                                                        placeholder="Masukan alasan"
                                                                        wire:model.live="formReason"
                                                                        autocomplete="off" />
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btnPrimary w-full"
                                                                        wire:target="addProduct, formQtyAktual"
                                                                        wire:loading.attr="disabled"
                                                                        wire:click="addProduct()"
                                                                        {{ $formReason == '' || $productSelected == '' ? 'disabled' : '' }}>
                                                                        Tambah
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            fill="none" viewBox="0 0 24 24"
                                                                            stroke-width="1.5" stroke="currentColor"
                                                                            class="size-4 stroke-2 inline-flex">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                d="M12 4.5v15m7.5-7.5h-15" />
                                                                        </svg>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            @forelse ($listProducts as $index => $item)
                                                                <tr class="item-adjustment"
                                                                    wire:key="product-adjustment-{{ $item['productID'] }}">
                                                                    <td class="px-4 py-4">{{ $index + 1 }}</td>
                                                                    <td class="px-6 py-4">{{ $item['productName'] }}
                                                                    </td>
                                                                    <td class="px-6 py-4">{{ $item['unitName'] }}</td>
                                                                    <td class="px-6 py-4">{{ $item['qtyAwal'] }}</td>
                                                                    <td class="px-6 py-4">{{ $item['qtyAktual'] }}
                                                                    </td>
                                                                    <td
                                                                        class="px-6 py-4 {{ $item['qtySelisih'] < 0 ? 'text-rose-600' : '' }}">
                                                                        {{ $item['qtySelisih'] }}
                                                                    </td>
                                                                    <td class="px-6 py-4">{{ $item['reason'] }}</td>
                                                                </tr>
                                                            @empty
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div
                class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                <button type="button"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 btn-close"
                    onclick="handleCLoseModal()">
                    Close
                </button>
                <x-button type="button" class="btnPrimary" id="saveStockAdjustment" wire:target="save"
                    wire:click="save()">
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
            </div>
        </div>
    </div>
</div>

@push('body-scripts')
    <script>
        function handleCLoseModal() {
            let modalStockAdjustment = new HSOverlay(document.querySelector('#modalStockAdjustment'));
            if ($('.item-adjustment').length === 0) {
                modalStockAdjustment.close();
                Livewire.dispatch('form-reset');
                return;
            }
            Swal.fire({
                title: 'Batal Penyesuaian Stok?',
                text: "Stok yang telah disesuaikan akan dibatalakan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: "#94a3b8",
                cancelButtonColor: "#9333ea",
                confirmButtonText: 'Ya, lanjutkan',
                cancelButtonText: 'Batal',
                allowOutsideClick: false,
                preConfirm: () => {
                    // Show loading
                    Swal.showLoading();

                    // Trigger ke Livewire
                    window.dispatchEvent(new CustomEvent('confirmCloseModal'));

                    return new Promise((resolve, reject) => {
                        const listener = (e) => {
                            console.log('Event detail:', e.detail[0]);
                            window.removeEventListener('close-modal', listener);

                            if (e.detail[0] === true) {
                                resolve();
                                console.log('Adjustment sukses!');
                            } else {
                                reject();
                                console.log('Adjustment gagal!');
                            }
                        };
                        window.addEventListener('close-modal', listener);
                    });
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    modalStockAdjustment.close();
                    Swal.fire({
                        title: 'Stock Adjustment Dibatalkan',
                        text: "Penyesuaian stok berhasil dibatalkan.",
                        icon: 'success',
                        confirmButtonColor: "#9333ea",
                        confirmButtonText: 'Oke',
                    });
                }
                $("#saveStockAdjustment").attr('disabled', false);

            }).catch(() => {
                Swal.fire({
                    title: 'Gagal',
                    text: "Terjadi kesalahan sistem.",
                    icon: 'error',
                    confirmButtonColor: "#9333ea",
                    confirmButtonText: 'Oke',
                });
            });
        }
        $(document).ready(function() {

            $(window).on('beforeunload', function(e) {
                if ($(".item-adjustment").length > 0) {
                    // Untuk sebagian besar browser modern, hanya ini yang dibaca
                    e.preventDefault();
                    e.returnValue = ''; // Chrome, Edge, Firefox dll akan munculkan warning bawaan
                }
            });

            const modalStockAdjustment = new HSOverlay(document.querySelector('#modalStockAdjustment'));
            $("#btnOpenModalStockAdjustment").on('click', function(e) {
                e.preventDefault();
                modalStockAdjustment.open();
            })
            $(".btn-close").on('click', function(e) {
                e.preventDefault();
                $("#saveStockAdjustment").attr('disabled', true);
            })


        })

        function initSelect2() {
            const $select = $('#productSearch');

            // Hanya jalankan kalau elemen ada
            if (!$select.length) return;

            // Destroy dulu jika sudah pernah diinisialisasi
            if ($select.hasClass('select2-hidden-accessible')) {
                $select.select2('destroy');
            }

            // Inisialisasi ulang
            $select.select2({
                placeholder: "Ketik nama barang",
                minimumInputLength: 2,
                width: '100%',
            });

            // Bind ulang event change
            $select.off('change').on('change', function() {
                var data = $('#productSearch').select2("val");
                @this.set('productSelected', data);
            });
        }
    </script>
@endpush

@script
    <script>
        setTimeout(() => {
            initSelect2();
        }, 10);

        $wire.on('adjustment-success', (event) => {
            console.log(event);
            let status = event[0]
            if (status === true) {
                const modalStockAdjustment = new HSOverlay(document.querySelector('#modalStockAdjustment'));
                modalStockAdjustment.close();
                Livewire.dispatch('form-reset');
                Swal.fire({
                    title: 'Stock Adjustment Success!',
                    text: "Penyesuaian stok berhasil.",
                    icon: 'success',
                    confirmButtonColor: "#9333ea",
                    confirmButtonText: 'Oke',
                });
            } else {
                // modalStockAdjustment.close();
                Swal.fire({
                    title: 'Gagal!',
                    text: "Terjadi kesalahan sistem, silahkan coba lagi.",
                    icon: 'error',
                    confirmButtonColor: "#9333ea",
                    confirmButtonText: 'Oke',
                });
            }

        });


        // Jalankan saat navigasi selesai
        document.addEventListener('livewire:navigated', () => {
            setTimeout(() => {
                initSelect2();
            }, 50); // Delay sedikit untuk pastikan DOM siap
        });

        // Jalankan saat DOM berubah (misalnya dari form)
        Livewire.hook('morphed', () => {
            initSelect2();
        });
    </script>
@endscript
