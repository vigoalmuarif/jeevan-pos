<form action="" wire:submit="save()">
    <div id="modalEditWarehouseAssigment"
        class="hs-overlay [--overlay-backdrop:static]  hidden size-full fixed top-0 start-0 z-[9999] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="modalStockAdjustment-label" wire:ignore.self>
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all md:max-w-xl w-full  m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
            <div
                class="max-h-full w-full overflow-hidden flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-isDark dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div
                    class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                    <h6 id="modalStockAdjustment-label" class="font-bold text-gray-800 dark:text-white">
                        Ubah Distribusi Gudang Ke Cabang
                    </h6>
                    <button type="button"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none btn-close dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                        aria-label="Close" onclick="handleCLoseModalEdit()">
                        <span class="sr-only">Close</span>
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
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
                                    <div class="flex flex-col space-y-4">
                                        <div>
                                            <label for="warehouseEdit"
                                                class="block text-sm font-medium mb-2 dark:text-white">Gudang</label>
                                            <select id="warehouseEdit" name="warehouseEdit" style="width:100%;" disabled>
                                                <option value="" wire:key="warehouseEdit-0">
                                                </option>
                                                @foreach ($warehouses as $item)
                                                    <option value="{{ $item['id'] }}" {{ $warehouseEdit == $item['id'] ? 'selected disabled' : '' }}
                                                        wire:key="warehouse-{{ $item['id'] }}">
                                                        [{{ $item->warehouse_code }}] - {{ $item['name'] }}</option>
                                                @endforeach
                                            </select>
                                            @error($warehouseEdit)
                                                <p class="isInvalidMessage mt-0.5" id="error-msg-{{ $warehouseEdit }}">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label for="branchEdit"
                                                class="block text-sm font-medium mb-2 dark:text-white">Gudang</label>
                                            <select id="branchEdit" name="branchEdit" style="width:100%;" {{ $warehouseEdit ? '' : 'disabled' }}>
                                                <option value="" wire:key="branchEdit-0">
                                                </option>
                                                @foreach ($branches as $branch)
                                                    <option value="{{ $branch['id'] }}" {{ $branchEdit == $branch['id'] ? 'selected' : '' }}
                                                        wire:key="warehouse-{{ $branch['id'] }}">
                                                        [{{ $branch->warehouse_code }}] - {{ $branch['name'] }}</option>
                                                @endforeach
                                            </select>
                                            @error($branchEdit)
                                                <p class="isInvalidMessage mt-0.5" id="error-msg-{{ $branchEdit }}">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>
                                     
                                        <div class="mb-4">
                                            <x-form.toggle name="status" id="status" value="1" label="Aktif" active="{{ $statusEdit == 1 ? true : false }}"
                                                id="status"
                                                wire:model="statusEdit"
                                             />
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
                        onclick="handleCLoseModalEdit()">
                        Close
                    </button>
                    <x-button type="submit" class="btnPrimary" id="saveWarehouseAssigment" wire:target="save">
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
</form>

@push('body-scripts')
    <script>
        function handleCLoseModalEdit() {
            let modalEditWarehouseAssigment = new HSOverlay(document.querySelector('#modalEditWarehouseAssigment'));
            modalEditWarehouseAssigment.close();
            Livewire.dispatch('reset-form-create-warehouse-assigment')
        }

        function warehouseEdit() {
            const $select = $('#warehouseEdit');

            // Hanya jalankan kalau elemen ada
            if (!$select.length) return;

            // Destroy dulu jika sudah pernah diinisialisasi
            if ($select.hasClass('select2-hidden-accessible')) {
                $select.select2('destroy');
            }

            // Inisialisasi ulang
            $select.select2({
                placeholder: "Ketik nama gudang",
                // minimumInputLength: 2,
                width: '100%',
            });

            // Bind ulang event change
            $select.off('change').on('change', function() {
                var data = $('#warehouseEdit').select2("val");
                @this.set('warehouseEdit', data);
            });
        }

        function branchEdit() {
            const $branch = $('#branchEdit');

            // Hanya jalankan kalau elemen ada
            if (!$branch.length) return;

            // Destroy dulu jika sudah pernah diinisialisasi
            if ($branch.hasClass('select2-hidden-accessible')) {
                $branch.select2('destroy');
            }

            // Inisialisasi ulang
            $branch.select2({
                placeholder: "Ketik nama gudang",
                // minimumInputLength: 2,
                width: '100%',
            });

            // Bind ulang event change
            $branch.off('change').on('change', function() {
                var data = $('#branchEdit').select2("val");
                @this.set('branchEdit', data);
            });
        }
        $(document).ready(function() {
            setTimeout(() => {
                warehouseEdit();
                branchEdit();
            }, 100);

            const modalEditWarehouseAssigment = new HSOverlay(document.querySelector('#modalEditWarehouseAssigment'));
            $("#btnOpenmodalEditWarehouseAssigment").on('click', function(e) {
                e.preventDefault();
                modalEditWarehouseAssigment.open();
            })
            $(".btn-close").on('click', function(e) {
                e.preventDefault();
                $("#saveStockAdjustment").attr('disabled', true);
            })


        })
    </script>
@endpush

@script
    <script>
        $wire.on('warehouse-assigment-updated', function(e) {
            handleCLoseModalEdit();
        })


        // Jalankan saat navigasi selesai
        document.addEventListener('livewire:navigated', () => {
            setTimeout(() => {
                warehouseEdit();
                branchEdit();
            }, 800); // Delay sedikit untuk pastikan DOM siap
        });

        // Jalankan saat DOM berubah (misalnya dari form)
        Livewire.hook('morphed', () => {
            warehouseEdit();
            branchEdit();
        });
    </script>
@endscript
